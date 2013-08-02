(function() {

var error_dialog_template = '<div class="error_notice">{error_html}</div>';

var http_error_dialog_template = '<div class="error_notice http_error_notice"><div class="http_status">{status}: {status_text_html}</div><div class="details_link"><a href="javascript:void(0)" onclick="CPANEL.animate.slide_toggle(this.parentNode.nextSibling)">Show/hide details</a></div><div class="cjt_error_details"><div class="url">URL ({method}):<pre>{url_html}</pre></div><div class="post">Post:<pre>{post_html}</pre></div><div class="response">Response:<pre>{response_html}</pre></div></div></div>';

var FADE_MODAL = { effect: CPANEL.animate.ContainerEffect.FADE_MODAL, duration: 0.25 };

CPANEL.ajax = { FADE_MODAL:FADE_MODAL };

//Get the texts of all <script type="text/plain"> elements.
CPANEL.ajax.templates = {};
YAHOO.util.Event.onDOMReady( function() {
    var scripts = document.getElementsByTagName("script");
    var scripts_length = scripts.length;
    var cur_script;
    for (var s=0; cur_script=scripts[s]; s++) {
        var id = cur_script.id;
        if ( id && cur_script.type === "text/plain" ) {
            CPANEL.ajax.templates[ id ] = cur_script.text.trim();
        }
    }
} );

var _transaction_args = {};
var async_request = function() {
    var conn = YAHOO.util.Connect.asyncRequest.apply( YAHOO.util.Connect, arguments );
    _transaction_args[ conn.tId ] = arguments;
    return conn;
};

var THIS_IS_WHM = CPANEL.application === "whostmgr";

//CPANEL.api()
//
//Normalize interactions with cPanel and WHM's APIs.
//
//Sort, filter, and pagination are passed in as api_data.
//They are formatted thus:
//
//sort: [ "foo", "!bar", ["baz","numeric"] ]
//  "foo" is sorted normally, "bar" is descending, then "baz" with method "numeric"
//
//filter: [ ["foo","contains","whatsit"], ["baz","gt",2], ["*","contains","bar"]
//  each [] is column,type,term
//  column of "*" is a wildcard search (only does "contains")
//
//paginate: { start: 12, size: 20 }
//  gets 20 records starting at index 12 (0-indexed)
var construct_api_query = function( args_obj ) {
    var api_version = args_obj.api_data && args_obj.api_data.version || (
        THIS_IS_WHM ? 1 : 2
    );

    var api_call = {};
    var api_version_int = parseInt(api_version);

    if ( (args_obj.application === "whm") || THIS_IS_WHM ) {
        api_call["api.version"] = api_version;

        if ( args_obj.data ) {
            YAHOO.lang.augmentObject( api_call, args_obj.data );
        }
    }
    else if ( api_version_int === 2 ) {
        api_call.cpanel_jsonapi_version = 2;
        api_call.cpanel_jsonapi_module  = args_obj.module;
        api_call.cpanel_jsonapi_func    = args_obj.func;

        if ( args_obj.data ) {
            YAHOO.lang.augmentObject( api_call, args_obj.data );
        }

        if ( args_obj.api_data ) {
            if ( "sort" in args_obj.api_data ) {
                var sort_count = args_obj.api_data.sort.length;

                if (sort_count) api_call.api2_sort = 1;

                for (var s=0; s<sort_count; s++) {
                    var cur_sort = args_obj.api_data.sort[s];
                    if ( cur_sort instanceof Array ) {
                        api_call["api2_sort_method_"+s] = cur_sort[1];
                        cur_sort = cur_sort[0];
                    }
                    if ( cur_sort.charAt(0) === "!" ) {
                        api_call["api2_sort_reverse_"+s] = 1;
                        cur_sort = cur_sort.substr(1);
                    }
                    api_call["api2_sort_column_"+s] = cur_sort;
                }
            }
            if ( "filter" in args_obj.api_data ) {
                var filter_count = args_obj.api_data.filter.length;

                if (filter_count) api_call.api2_filter = 1;

                for (var f=0; f<filter_count; f++) {
                    var cur_filter = args_obj.api_data.filter[f];
                    if ( cur_filter[0] === "*" ) {
                        api_call["api2_filter_searchall"] = cur_filter[2];
                    }
                    else {
                        api_call["api2_filter_column_"+f] = cur_filter[0];
                        api_call["api2_filter_type_"+f]   = cur_filter[1];
                        api_call["api2_filter_term_"+f]   = cur_filter[2];
                    }
                }
            }
            if ( "paginate" in args_obj.api_data ) {
                api_call.api2_paginate = 1;
                if ( "start" in args_obj.api_data.paginate ) {
                    api_call.api2_paginate_start = args_obj.api_data.paginate.start + 1;
                }
                if ( "size" in args_obj.api_data.paginate ) {
                    api_call.api2_paginate_size = args_obj.api_data.paginate.size;
                }
            }
        }
    }
    //for API 1, data is just a list
    else if ( api_version_int === 1 ) {
        api_call.cpanel_jsonapi_version = 1;
        api_call.cpanel_jsonapi_module  = args_obj.module;
        api_call.cpanel_jsonapi_func    = args_obj.func;

        for (var d=0; d<args_obj.api_data.length; d++) {
            api_call["arg-"+d] = args_obj.api_data[d];
        }
    }

    //timestamp to prevent browser caching
    if ( !args_obj.api_data || !args_obj.api_data.allow_cache ) {
        api_call.__cache_fix = (new Date()).getTime();
    }

    return CPANEL.util.make_query_string(api_call);
}
var api = function( args_obj ) {
    var query_string = construct_api_query( args_obj );

    var callback = args_obj.callback || {};
    var pp_opts = args_obj.progress_panel;
    if ( pp_opts ) {
        var pp = new Progress_Panel( pp_opts );
        var source_el = pp_opts.source_el;
        if ( source_el ) {
            pp.show_from_source( source_el );
        }
        else {
            pp.cfg.setProperty( "effect", FADE_MODAL );
            pp.show();
        }

        var given_success = callback && callback.success;
        var pp_callback = CPANEL.ajax.build_callback(
            function(result) {

                //This gives us a means of interrupting the normal response to
                //a successful return, e.g., if we want to display a warning
                //about a partial success.
                if ( pp_opts.before_success && pp_opts.before_success.call(pp,result) === false ) {
                    return;
                }

                if ( source_el ) {
                    pp.hide_to_point( source_el );
                }
                else {
                    pp.hide();
                }

                var notice_opts = pp_opts.success_notice_options || {};
                YAHOO.lang.augmentObject( notice_opts, {
                    level:   "success",
                    content: pp_opts.success_status || CPANEL.LANG.success
                } );

                req_obj.notice = new DynamicNotice( notice_opts );

                return given_success && given_success.apply(this,arguments);
            },
            { current: pp },
            { whm: args_obj.application === "whm" }
        );
        YAHOO.lang.augmentObject( callback, pp_callback, true );
    }

    var is_whm = (args_obj.application === "whm") || THIS_IS_WHM;
    var url = CPANEL.security_token + (
        is_whm ? ("/json-api/" + args_obj.func) : api.cpanel_url
    );

    var post_string = api.construct_query(args_obj);
    var req_obj = async_request("POST", url, callback, post_string);

    if (pp) req_obj.progress_panel = pp;

    return req_obj;
};
api.cpanel_url = "/json-api/cpanel";

CPANEL.api = api;
CPANEL.api.construct_query = construct_api_query;



//static method build_callback()
//
//builds a callback object for YAHOO.util.Connect.asyncRequest()
//that assumes user input/response based on modal panels
//
//panels:
//  current: the current panel
//  success: the panel to show on success
//  after_error: the panel to show after the error panel
//opts:
//  whm: interpret results as WHM API 1 calls
//  on_error: callback when user closes error dialog box
//  keep_current_on_success: Do nothing with panels on success.
CPANEL.ajax.build_callback = function(success_func, panels, opts) {
    var from_panel, after_error_panel;

    if (!opts) opts = {};
    if (panels) {
        from_panel = panels.current;
        after_error_panel = panels.after_error;
    }

    var failure = function(o) {
        if ("console" in window) console.warn('API error:',o);

        var error_text, is_http_error;
        if ( !o ) {
            error_text = CPANEL.LANG.unknown_error;
        }
        else if ( o.status && o.status !== 200 ) {
            is_http_error = true;
        }
        else if ( o.responseText ) {
            error_text = o.responseText;
        }
        else if ( o.error ) {
            error_text = String(o.error);
        }
        else {
            error_text = String(o);
        }

        //context is the error dialog
        var error_dialog_closer;
        if (after_error_panel) {
            error_dialog_closer = function() {
                var error_dialog = this;
                var fade_out_in = error_dialog.fade_to(after_error_panel);
                fade_out_in[0].onComplete.subscribe( function() {
                    error_dialog.destroy();
                } );
            };
        }
        else {
            error_dialog_closer = function() { this.cancel() };
        }

        var error_dialog = new Common_Dialog( DOM.generateId(), {
            width:   "400px",
            buttons: [
                { text:CPANEL.LANG.ok, handler:error_dialog_closer, isDefault:true }
            ]
        } );
        DOM.addClass( error_dialog.element, "cjt_notice_dialog cjt_error_dialog" );
        var header_html = this.header ? this.header.innerHTML
            : is_http_error ? CPANEL.LANG.http_error_allcaps
            : CPANEL.LANG.error_allcaps
        ;
        error_dialog.setHeader( header_html );

        if ( is_http_error ) {
            var async_args = _transaction_args[o.tId];

            //sort the headers
            var headers_html = o.getAllResponseHeaders
                .trim()
                .split(/[\r\n]+/)
                .sort()
                .join("\n")
                .html_encode()
            ;

            error_dialog.setBody( YAHOO.lang.substitute( http_error_dialog_template, {
                status: o.status,
                status_text_html: o.statusText.html_encode(),
                method : async_args[0],
                url_html: async_args[1].html_encode(),
                post_html: ( async_args[3] || "" ).html_encode(),
                response_html: ( headers_html + "\n\n" + o.responseText.html_encode() ).trim()
            } ) );
        }
        else {
            error_dialog.setBody( YAHOO.lang.substitute( error_dialog_template, {
                error_html: error_text.html_encode()
            } ) );
        }

        error_dialog.render(document.body);
        error_dialog.center();

        if (opts.on_error) error_dialog.cancelEvent.subscribe( opts.on_error );

        if ( from_panel ) {
            var fade_out_in = from_panel.fade_to(error_dialog);
            if ( !after_error_panel ) {
                fade_out_in[0].onComplete.subscribe( function() {
                    from_panel.destroy();
                } );
            }
        }
        else {
            //Show this dialog without a fade-in so it will be "alarming".
            error_dialog.show();
        }

        if ( !after_error_panel ) {
            error_dialog.cfg.setProperty( "effect", FADE_MODAL );
        }
    };

    var success = function(o) {
        var resp;
        try {
            resp = YAHOO.lang.JSON.parse(o.responseText);
        }
        catch(e) {
            if ( "console" in window ) console.warn(e);
            resp = null;
        }

        if (!resp) {
            failure.call(this,o);
            return;
        }

        var result;

        if (opts.whm) {
            if (!resp.metadata) {
                failure.call(this,o);
                return;
            }
            //fuzzy match is intended
            else if ( resp.metadata.result != 1 ) {
                failure.call(this,resp.metadata.reason);
                return;
            }
            result = resp.data;
        }
        else {
            if (!resp.cpanelresult) {
                failure.call(this,o);
                return;
            }
            else if ("error" in resp.cpanelresult) {
                failure.call(this,resp.cpanelresult.error);
                return;
            }
            result = resp.cpanelresult;
        }

        if (success_func) success_func.call(this,result);
        if ( from_panel && !opts.keep_current_on_success ) {
            if ( panels.success ) {
                from_panel.fade_to( panels.success );
            }
            else {
                var old_effect = from_panel.cfg.getProperty("effect");
                from_panel.cfg.setProperty( "effect", FADE_MODAL );
                from_panel.hideEvent.subscribe( function hider() {
                    //in case a panel isn't destroyed on hide,
                    //we just want to call this once
                    this.hideEvent.unsubscribe( hider );
                    this.cfg.setProperty("effect", old_effect);
                    from_panel.destroy();
                } );
                from_panel.hide();
            }
        }
    };

    return { success:success, failure:failure };
};


//class Progress_Overlay
//
//A simple overlay with a throbber and fading status text.

var progress_overlay_opts = {
    visible: false
};
var Progress_Overlay = function(id, opts) {
    if (!id) id = DOM.generateId();

    if (!opts) opts = {};
    if ( !("show_status" in opts) ) opts.show_status = !!opts.status_html;
    YAHOO.lang.augmentObject( opts, progress_overlay_opts );

    //to prevent Overlay() from being called twice from Progress_Panel
    if (!this.cfg) YAHOO.widget.Overlay.call(this, id/*, opts*/);

    this.beforeInitEvent.fire(Progress_Panel);

    DOM.addClass( this.element, "cjt_progress_overlay" );

    this.cfg.applyConfig(opts, true);

    var body_html = "<div class=\"cjt_progress_overlay_body_liner\">"
        + "<div class=\"loader-tool\"><div class=\"loader\"></div></div>"
    ;
    if ( opts.show_status ) {
        body_html += "<div class=\"cjt_progress_overlay_text_container\">"
            + "<span class=\"cjt_progress_overlay_text\">"
            + (opts.status_html || "&nbsp;")   //so it has a line height
            + "</span></div>"
        ;
        this.renderEvent.subscribe( function add_fade() {
            this.renderEvent.unsubscribe(add_fade);
            var text_field = DOM.getElementsByClassName("cjt_progress_overlay_text","span",this.body)[0];
            this.fading_text_field = new CPANEL.ajax.Fading_Text_Field( text_field );
        } );
    }
    body_html += "</div>";

    this.setBody( body_html );

    this.throbber = this.body.firstChild.firstChild;

    DOM.setStyle( this.body, "border", 0 ); //in case
}
CPANEL.ajax.Progress_Overlay = Progress_Overlay;
YAHOO.lang.extend(Progress_Overlay, YAHOO.widget.Overlay, {
    initDefaultConfig : function(no_recursion) {
        if (!no_recursion) {
            Progress_Overlay.superclass.initDefaultConfig.call(this);
        }

        this.cfg.addProperty("show_status", { value: false });
        this.cfg.addProperty("status_html", { value: "" } );
    },
    set_status : function(new_html) {
        this.cfg.setProperty("status_html", new_html);
        if ( this.cfg.getProperty("show_status") ) {
            this.fading_text_field.set_html(new_html);
        }
    },
    set_status_now : function(new_html) {
        this.cfg.setProperty("status_html", new_html);
        if ( this.cfg.getProperty("show_status") ) {
            this.fading_text_field.set_html_now(new_html);
        }
    },
    throbber : null,
    fading_text_field : null
});



//class Progress_Panel
//
//A modal panel variant of Progress_Overlay.

var progress_panel_opts = {
    modal: true,
    fixedcenter: true,
    draggable: false,
    dragOnly: true,
    close: false,
    underlay: "none",
    monitorresize: false,  //for IE7; see case 48257
    visible: false
};
var Progress_Panel = function(id, opts) {
    if (!id) {
        id = DOM.generateId();
    }
    else if ( typeof id === "object" ) {
        opts = id;
        id = DOM.generateId();
    }

    if (!opts) opts = {};
    YAHOO.lang.augmentObject( opts, progress_panel_opts );

    YAHOO.widget.Panel.call(this, id/*, opts*/);
    Progress_Overlay.call(this, id, opts);

    this.beforeInitEvent.fire(Progress_Panel);

    DOM.addClass( this.element, "cjt_progress_panel" );

    this.cfg.applyConfig(opts, true);

    this.make_autorender();
}
CPANEL.ajax.Progress_Panel = Progress_Panel;
YAHOO.lang.extend( Progress_Panel, YAHOO.widget.Panel, {
    initDefaultConfig : function() {
        Progress_Panel.superclass.initDefaultConfig.call(this);
        Progress_Overlay.prototype.initDefaultConfig.call(this, true);
    }
} );
YAHOO.lang.augment( Progress_Panel, Progress_Overlay );



//class Fading_Text_Field
//
//Make a text field fade among value assignments.
//NOTE: The text values passed in are HTML, so be sure and HTML-encode them.

CPANEL.ajax.Fading_Text_Field = function(dom_node) {
    dom_node = DOM.get(dom_node);
    DOM.addClass( dom_node, "fading_text_field" );
    this._dom_node = dom_node;
    this._dom_node_parent = dom_node.parentNode;

    this._prototype_node = dom_node.cloneNode(false);
    this._prototype_node.style.display = "none";
    this._prototype_node.style.position = "absolute";
};
YAHOO.lang.augmentObject( CPANEL.ajax.Fading_Text_Field.prototype, {
    set_html_now: function(new_html) {
        if (this._fade_in)  this._fade_in.stop();
        if (this._fade_out) this._fade_out.stop();
        this._dom_node.innerHTML = new_html;
        DOM.setStyle( this._dom_node, "opacity", "" );
        this._fade_in = null;
        this._fade_out = null;
    },
    _fade_in: null,
    _fade_in_el: null,
    _fade_out: null,
    _dom_node: null,
    _dom_node_parent: null,
    set_html: function(new_html) {
        var old_dom_node = this._dom_node;

        var dom_node_parent = this._dom_node_parent;

        var new_span = this._prototype_node.cloneNode(false);
        new_span.id = DOM.generateId();
        new_span.innerHTML = new_html;
        dom_node_parent.insertBefore( new_span, this._dom_node );

        //something was being faded in already, so kill that
        if ( this._fade_in ) {
            this._fade_in.stop();
            dom_node_parent.removeChild( this._fade_in_el );
        }

        var fading_text_field = this;

        //the new fade-in
        this._fade_in = CPANEL.animate.fade_in(new_span);
        this._fade_in.onComplete.subscribe( function() {
            fading_text_field._fade_in = null;
        } );
        this._fade_in_el = new_span;

        if ( !this._fade_out ) {
            var fade_out = CPANEL.animate.fade_out( old_dom_node );
            fade_out.onComplete.subscribe( function() {
                dom_node_parent.removeChild( old_dom_node );
                new_span.style.position = "";
                fading_text_field._dom_node = new_span;

                fading_text_field._fade_out = null;
            } );
            this._fade_out = fade_out;
        }
    }
} );



//YAHOO.widget.Panel.prototype.fade_to()
//
//for fading from "this" modal panel to another
//
//This assumes both Panels are modal.
//Fading between Panels if one is not modal can be done with
//CPANEL.animate.ContainerEffect.FADE_MODAL (if one is modal)
//or YAHOO.widget.ContainerEffect.FADE (if neither is modal)
YAHOO.widget.Panel.prototype.fade_to = function(other_panel) {
    var panel = this;

    other_panel.cfg.setProperty("zIndex", this.cfg.getProperty("zIndex")+1);

    var the_mask = this.mask;

    var other_mask = other_panel.mask;

    //remove other_panel's own mask
    if ( other_mask && DOM.inDocument(other_mask) ) {
        other_mask.parentNode.removeChild(other_mask);
    }

    //A reasonable guess that YUI 2 will not change the mask ID scheme...
    //...otherwise it would be prudent to do other_panel.buildMask() and then
    //assign the_mask.id to be that ID.
    the_mask.id = other_panel.id + "_mask";

    //exchange masks
    other_panel.mask = the_mask;
    this.mask = null;

    var fade_out = new YAHOO.util.Anim( panel.element, {
        opacity: { to: 0 }
    }, 0.25 );
    fade_out.onComplete.subscribe( function() {
        delete panel._fade;

        panel.hide();
        if ( panel.cfg ) {  //in case destroy() is subscribed to hide()
            DOM.setStyle( panel.element, "opacity", "" );
        }
    } );
    if ( "_fade" in panel ) {
        var _hide = panel.hide;
        panel.hide = function() {};  //in case onComplete would hide() the panel
        panel._fade.stop();
        panel.hide = _hide;
    }
    panel._fade = fade_out;
    fade_out.animate();

    DOM.setStyle(other_panel.element,"opacity",0);
    other_panel.show();

    //set a z-index above the other panel's mask so we still see the fade out
    var target_zindex = parseFloat( CPANEL.dom.get_zindex(the_mask) ) + 1;
    DOM.setStyle( panel.element, 'z-index', target_zindex );

    var fade_in = new YAHOO.util.Anim( other_panel.element, {
        opacity: { to: 1 }
    }, 0.25 );
    fade_in.onComplete.subscribe( function() {
        DOM.setStyle( other_panel.element, "opacity", "" );
        delete other_panel._fade;
    } );
    if ( "_fade" in other_panel ) {
        var _hide = other_panel.hide;
        other_panel.hide = function() {};
        other_panel._fade.stop();
        other_panel.hide = _hide;
    }
    other_panel._fade = fade_in;
    fade_in.animate();

    return [fade_out, fade_in];
};



//YAHOO.widget.Panel.prototype.show_from_source()
//
//Show a Panel zooming/moving from a particular point,
//fading in the modal mask if it is a modal Panel.
//
//source is either a DOM element (string/object) or an [x,y] array
YAHOO.widget.Panel.prototype.show_from_source = function( source ) {
    var clicked_el, source_xy;
    if ( source instanceof Array ) {
        source_xy = source;
    }
    else {
        //make the Overlay appear as though it came from the middle of the source el
        clicked_el = DOM.get(source);
        source_xy = _find_el_center(clicked_el);
    }

    var this_el = this.element;
    var this_el_style = this_el.style;

    var modal = this.cfg.getProperty("modal");

    var get_style = DOM.getStyle;

    DOM.setStyle(this_el, "opacity", 0);
    if (modal) {
        this.beforeShowMaskEvent.subscribe( function make_clear() {
            //we only want this function to be called once
            this.beforeShowMaskEvent.unsubscribe( make_clear );

            DOM.setStyle(this.mask,"opacity",0);
        } );
    }

    var already_shown = this._already_shown;
    if ( !already_shown ) {
        this.beforeShowEvent.subscribe( function to_center() {
            this.beforeShowEvent.unsubscribe( to_center );
            this.center();
            this._already_shown = true;
        } );
    }

    this.show();
    var target_xy = DOM.getXY( this_el );

    //this prevents things from sliding around as we expand
    var inner_el = this.innerElement;
    var inner_el_style = inner_el.style;

    var inner_width_to_restore  = inner_el_style.width;
    var inner_height_to_restore = inner_el_style.height;
    var outer_width_to_restore  = this_el_style.width;
    var outer_height_to_restore = this_el_style.height;

    var target_width = DOM.getStyle(inner_el,"width");
    if ( target_width === "auto" ) target_width = inner_el.offsetWidth+"px";
    var target_height = DOM.getStyle(inner_el,"height");
    if ( target_height === "auto" ) target_height = inner_el.offsetHeight+"px";
    inner_el_style.height = target_height;
    inner_el_style.width = target_width;


    this_el_style.overflow = "hidden";
    this_el_style.width  = 0;
    this_el_style.height = 0;

    DOM.setStyle(this_el,  "opacity","");

    var motion = new YAHOO.util.Motion( this_el, {
        points: { from: source_xy, to: target_xy },
        width:  { from: 0, to: parseFloat(target_width) },
        height: { from: 0, to: parseFloat(target_height) }
    }, 0.25 );

    this.element.style.overflow = "hidden";
    motion.animate();

    motion.onComplete.subscribe( function() {
        inner_el_style.width  = inner_width_to_restore;
        inner_el_style.height = inner_height_to_restore;
        this_el_style.width  = outer_width_to_restore;
        this_el_style.height = outer_height_to_restore;
    } );

    //set visibility to hidden to allow fade_in() to the CSS-given opacity
    if (modal) {
        this.mask.style.visibility = "hidden";
        DOM.setStyle( this.mask, "opacity", "" );
        CPANEL.animate.fade_in(this.mask);
        this.mask.style.visibility = "";
    }

    return motion;
}


//YAHOO.widget.Panel.prototype.hide_to_point()
//
//Hide Panel zooming/moving to a particular point,
//fading out the modal mask if it is a modal Panel.
//If the "point" is a DOM node, the Panel zooms to the node's center,
//and the node, if possible, is focused once the animation is done.
//
//point_xy is either a DOM element (string/object) or an [x,y] array
YAHOO.widget.Panel.prototype.hide_to_point = function( point_xy ) {
    var clicked_el;
    if ( !(point_xy instanceof Array) ) {
        clicked_el = DOM.get(point_xy);
        point_xy = _find_el_center(clicked_el);
    }

    var panel = this;
    var panel_el = this.element;
    panel_el.style.overflow = "hidden";
    var last_xy = DOM.getXY(panel_el);
    var motion = new YAHOO.util.Motion( panel_el, {
        points: { from: last_xy, to: point_xy },
        width: { to: 0 },
        height: { to: 0 }
    }, 0.25 );
    motion.animate();
    if ( this.mask ) var fade_out = CPANEL.animate.fade_out(this.mask);
    motion.onComplete.subscribe( function() {
        panel.hideEvent.subscribe( function clean_up() {
            panel.hideEvent.unsubscribe( clean_up );
            DOM.setXY(panel_el, last_xy);
            panel_el.style.height = "";
            panel_el.style.width  = "";
            if (clicked_el && clicked_el.focus) {
                var el_is_on_screen = CPANEL.dom.get_viewport_region()
                    .contains( DOM.getRegion(clicked_el) );
                if ( el_is_on_screen ) clicked_el.focus();
            }
        } );
        if (fade_out) fade_out.stop(true);
    } );

    return motion;
};



//get_viewport_region()
CPANEL.dom.get_viewport_region = function() {
    var vp_width  = DOM.getViewportWidth();
    var vp_height = DOM.getViewportHeight();

    var scroll_x = window.scrollX;
    var scroll_y = window.scrollY;
    return new YAHOO.util.Region(
        scroll_y,
        scroll_x + vp_width,
        scroll_y + vp_height,
        scroll_x
    );
};



//YAHOO.widget.Module.prototype.make_autorender()
//
//a shortcut function that relieves us of the need to render Modules to
//document.body (which is where most of them go, since they are Panel or Dialog
//instances generally).

YAHOO.widget.Module.prototype.make_autorender = function() {
    var _show = this.show;
    var _rendered = false;
    this.renderEvent.subscribe( function() {
        _rendered = true;
    } );
    this.show = function() {
        if (!_rendered) {
            this.render(document.body);
            _rendered = true;
        }
        this.show = _show;
        return _show.apply(this,arguments);
    };
}



//class Common_Dialog
//extends YAHOO.widget.Dialog
//
//a set of standard behaviors for Dialog instances, including:
//  behavior
//  buttons
//  form handling (manual only)
//  destroy on cancel()
//  modal mask over the body & footer and show a Progress_Overlay on submit

var standard_dialog_opts = {
    modal:  true,
    draggable: true,
    close: false,
    visible: false,
    postmethod: "manual",
    hideaftersubmit: false,
    effect: null,  //so resetProperty() will work on this
    buttons: [
        {
            text:      CPANEL.LANG.proceed,
            handler:   function() { this.submit(); },
            isDefault: true
        },
        { text: CPANEL.LANG.cancel, handler:function() { this.cancel() } }
    ]
};
var Common_Dialog = function( id, opts ) {
    if ( typeof id === "object" ) {
        opts = id;
        id = DOM.generateId();
    }
    else if (!id) {
        id = DOM.generateId();
    }

    //assign standard props
    //assign submit handler - hide/destroy
    if (!opts) opts = {};
    YAHOO.lang.augmentObject(opts,standard_dialog_opts);

    Common_Dialog.superclass.constructor.call(this, id/*, opts */);

    this.beforeInitEvent.fire(Common_Dialog);

    DOM.addClass( this.element, "cjt_common_dialog_container" );

    this.cfg.applyConfig(opts, true);

    this.setHeader("");
    this.setBody("");
    this.form.action = "javascript:void(0)";

    this.make_autorender();

    var the_dialog=this;
    this.form.onsubmit = function() { return false };  //YUI does its own submit()
    if ( this.cfg.getProperty("draggable") && this.cfg.getProperty("fixedcenter") ) {
        this.showEvent.subscribe( function() {
            this.cfg.setProperty( "fixedcenter", false, false );
        } );
        this.hideEvent.subscribe( function() {
            DOM.setStyle( this.element, "left", "" );
            DOM.setStyle( this.element, "top", "" );
            this.cfg.setProperty( "fixedcenter", true, false );
        } );
    }

    this.cancelEvent.subscribe( function() {
        this.hideEvent.subscribe( function destroyer() {
            //so successive cancelEvents will not create lots of these:
            this.hideEvent.unsubscribe( destroyer );

            //The time delay allows things to "clear out".
            //TODO: Figure out what is really going on here.
            setTimeout( function() { the_dialog.destroy() }, 100 );
        } );
    } );

    this.manualSubmitEvent.subscribe( function() {
        if ( this.cfg.getProperty("progress_overlay") ) {
            var body_region = DOM.getRegion( this.body );
            var footer_region = DOM.getRegion( this.footer );

            var mask_z_index = parseFloat(CPANEL.dom.get_zindex(this.element)) + 1;

            var dummy_div = document.createElement("div");
            var div_html_template = "<div class='cjt_common_dialog_mask' style='"
                + "position:absolute;visibility:hidden;"
                + "z-index:{z_index};"
                + "background-color:{body_background_color};"
                + "width:{body_inner_width}px;"
                + "height:{body_inner_height}px;"
            + "'>&nbsp;</div>"
            + "<div class='cjt_common_dialog_mask' style='"
                + "position:absolute;visibility:hidden;"
                + "z-index:{z_index};"
                + "background-color:{footer_background_color};"
                + "width:{footer_inner_width}px;"
                + "height:{footer_inner_height}px;"
            + "'>&nbsp;</div>"
            ;
            var div_html = YAHOO.lang.substitute( div_html_template, {
                z_index:                   mask_z_index,
                body_background_color:     CPANEL.dom.get_background_color(this.body),
                body_inner_width:          body_region.width,
                body_inner_height:         body_region.height,
                footer_background_color:   CPANEL.dom.get_background_color(this.footer),
                footer_inner_width:        footer_region.width,
                footer_inner_height:       footer_region.height
            } );
            dummy_div.innerHTML = div_html;
            var body_mask   = dummy_div.firstChild;
            var footer_mask = dummy_div.lastChild;

            //Different browsers report this value differently,
            //and YUI doesn't perfectly abstract it all away.
            var target_opacity = DOM.getStyle(body_mask,"opacity");
            if ( !target_opacity || target_opacity == 1 ) target_opacity = 0.7;

            DOM.setStyle( body_mask,   "opacity", 0 );
            DOM.setStyle( footer_mask, "opacity", 0 );

            body_mask.style.visibility = "";
            footer_mask.style.visibility = "";

            var body_fader = new YAHOO.util.Anim( body_mask, {
                opacity: { to: target_opacity }
            }, 0.25 );
            var footer_fader = new YAHOO.util.Anim( footer_mask, {
                opacity: { to: target_opacity }
            }, 0.25 );

            this.body.appendChild(body_mask);
            this.footer.appendChild(footer_mask);

            //in case there is no height/width set on the body or footer
            DOM.setXY(body_mask, [body_region.left, body_region.top]);
            DOM.setXY(footer_mask, [footer_region.left, footer_region.top]);

            body_fader.animate();
            footer_fader.animate();

            var progress_overlay = new Progress_Overlay( null, {
                zIndex:  mask_z_index+1,
                visible: false,
                show_status: this.cfg.getProperty("show_status"),
                status_html: this.cfg.getProperty("status_html")
            } );
            progress_overlay.render(this.body);

            DOM.setStyle( progress_overlay.body, "opacity", 0 );

            var fade_in = new YAHOO.util.Anim( progress_overlay.body, {
                opacity: { to: 1 }
            }, 0.25 );


            progress_overlay.showEvent.subscribe( function() {
                DOM.setXY( this.element, [
                    body_region.left + body_region.width/2 - this.element.offsetWidth/2,
                    (footer_region.bottom + body_region.top)/2 - this.element.offsetHeight/2
                ] );

                fade_in.animate();
            } );

            progress_overlay.show();
            this.progress_overlay = progress_overlay;


            //prevent focusing anything by making an invisible modal panel
            //lamentably, this prevents dragging the original Dialog
            var focus_killer = new YAHOO.widget.Panel( DOM.generateId(), {
                modal:   true,
                x: DOM.getX( this.element ),
                y: DOM.getY( this.element ),
                visible: false
            } );
            focus_killer.render(this.element);
            focus_killer.buildMask();
            DOM.setStyle( focus_killer.element, "opacity", 0 );
            DOM.setStyle( focus_killer.mask,    "opacity", 0 );
            focus_killer.show();

            //undo the fades and disables after hide, in case this gets reshown
            this.hideEvent.subscribe( function kill_mask() {
                this.hideEvent.unsubscribe( kill_mask );

                this.body.removeChild( body_mask );
                this.footer.removeChild( footer_mask );
                focus_killer.destroy();
                progress_overlay.destroy();
            } );
        }
        else {
            this.cfg.setProperty( "effect", FADE_MODAL );
            this.hide();
        }
    } );
};
Common_Dialog.default_options = standard_dialog_opts;
YAHOO.lang.extend(Common_Dialog, YAHOO.widget.Dialog, {
    initDefaultConfig : function() {
        YAHOO.widget.Dialog.prototype.initDefaultConfig.call(this);

        this.cfg.addProperty("progress_overlay", { value: true });
        this.cfg.addProperty("show_status", { value: false });
        this.cfg.addProperty("status_html", { value: "" });
    },
    showMacGeckoScrollbars : function() {},
    hideMacGeckoScrollbars : function() {}
});
CPANEL.ajax.Common_Dialog = Common_Dialog;

var _find_el_center = function(el) {
    var xy = DOM.getXY(el);
    xy[0] += ( parseFloat( DOM.getStyle(el,"width") ) || el.offsetWidth ) / 2;
    xy[1] += ( parseFloat( DOM.getStyle(el,"height") ) || el.offsetHeight ) / 2;
    return xy;
};



//class Common_Action_Dialog
//extends Common_Dialog
//
//a further abstraction from Common_Dialog that implements standard behaviors
//like form templates, chaining API calls, etc. In theory, no interaction with
//setHeader/setBody/etc. is necessary when using this class.
//
//properties:
//  notice: a Notice instance that the Common_Action_Dialog creates
//
//opts:
//  header_html
//  clicked_element
//  preload: an API call (see below) to run before showing the dialog box
//  show_status: boolean
//  status_template: template (YAHOO.lang.substitute) for the submit status
//      may be specified per API call as well
//  form_template: template (YAHOO.lang.substitute) for the form HTML
//  form_template_variables: object, or function that returns an object
//  no_hide_after_success: Keep the dialog box in place after the last API call
//  success_function: Executed after the last API call succeeds.
//  success_status: Text (should it be a template?) for the last API call.
//  success_notice_options: Options to pass to the success Notice
//  api_calls: array:
//      api_application: "whm" if WHM; otherwise cpanel
//      api_module
//      api_function
//      data: for the function call itself (e.g. user, domain, etc.)
//      api_data: sort/filter/paginate
//      status_template: see above
//      success_function: see above

var standard_action_dialog_opts = {
    buttons: [
        {
            text:      CPANEL.LANG.proceed,
            handler:   function() { this.submit(); },
            isDefault: true
        },
        { text: CPANEL.LANG.cancel, handler:function() { this.animated_cancel() } }
    ]
};
var Common_Action_Dialog = function( id, opts ) {
    if (!opts) opts = {};
    YAHOO.lang.augmentObject(opts,standard_action_dialog_opts);

    Common_Action_Dialog.superclass.constructor.call(this, id, opts);

    if (opts.header_html) this.setHeader(opts.header_html);

    var the_dialog = this;

    if (opts.preload) {
        var loading_panel = new Progress_Panel();
        loading_panel.render(document.body);
        if (opts.clicked_element) {
            loading_panel.show_from_source( opts.clicked_element );
        }
        else {
            loading_panel.show();
        }

        var preload_copy = {
            application: opts.preload.api_application,
            module:      opts.preload.api_module,
            func:        opts.preload.api_function,
            data:        opts.preload.data,
            api_data:    opts.preload.api_data,
            callback:    null
        };

        var given_callback = opts.preload.callback;

        var preload_callback = CPANEL.ajax.build_callback(
            function (cpanelresult) {
                if (given_callback) given_callback.call(the_dialog,cpanelresult);

                the_dialog.beforeShowEvent.subscribe( function center() {
                    the_dialog.beforeShowEvent.unsubscribe(center);
                    the_dialog.center();
                } );

                var form_template = the_dialog.cfg.getProperty("form_template");
                if (form_template) {
                    var template_vars;
                    if (opts.form_template_variables instanceof Function) {
                        template_vars = opts.form_template_variables.call(the_dialog,cpanelresult);
                    }
                    else {
                        template_vars = opts.form_template_variables;
                    }

                    var template_text = CPANEL.ajax.templates[form_template] || form_template;
                    the_dialog.form.innerHTML = YAHOO.lang.substitute( template_text, template_vars || {} );
                }

            },
            {
                current: loading_panel,
                success: the_dialog
            },
            {
                whm: opts.preload.api_application && opts.preload.api_application === "whm"
            }
        );

        preload_copy.callback = preload_callback;

        CPANEL.api(preload_copy);
    }
    else {
        if (opts.form_template) {
            var template_text = CPANEL.ajax.templates[opts.form_template] || opts.form_template;
            this.form.innerHTML = YAHOO.lang.substitute( template_text, opts.form_template_variables || {} );
        }
    }

    this.manualSubmitEvent.subscribe( function() {
        var api_calls = this.cfg.getProperty("api_calls");

        if (!api_calls) return;

        var index=0;
        var _run_api_call_queue = function() {
            var cur_api_call = api_calls[index];
            var is_first_api_call = (index === 0);
            var is_last_api_call = (index === api_calls.length-1);
            index++;

            var data;
            if ( cur_api_call.data ) {
                if ( cur_api_call.data instanceof Function ) {
                    data = cur_api_call.data.apply(the_dialog);
                }
                else {
                    data = cur_api_call.data;
                }
            }
            else {
                data = CPANEL.dom.get_data_from_form( the_dialog.form );
            }

            var do_before;

            var callback_success = is_last_api_call
                ? function(result) {
                    if ( cur_api_call.success_function ) cur_api_call.success_function.call(the_dialog,result);

                    if ( the_dialog.cfg.getProperty("show_status") ) {
                        var success_opts = the_dialog.cfg.getProperty("success_notice_options") || {};
                        if ( !success_opts.content) {
                            success_opts.content = the_dialog.cfg.getProperty("success_status") || CPANEL.LANG.success;
                            if ( !success_opts.level ) success_opts.level = "success";
                        }
                        the_dialog.notice = new DynamicNotice( success_opts );
                    }

                    if ( the_dialog.cfg.getProperty("success_function") ) {
                        the_dialog.cfg.getProperty("success_function").call(the_dialog);
                    }
                }
                : function(result) {
                    if ( cur_api_call.success_function ) cur_api_call.success_function.call(the_dialog,result);
                    _run_api_call_queue();
                }
            ;

            var status_template = opts.show_status && (cur_api_call.status_template || opts.status_template);
            if (status_template) {
                var data_html = {};
                for (var key in data) data_html[key] = String(data[key]).html_encode();
                var status_html = YAHOO.lang.substitute( status_template, data_html );
                if (is_first_api_call) {
                    the_dialog.progress_overlay.set_status_now( status_html );
                }
                else {
                    the_dialog.progress_overlay.set_status( status_html );
                }
            }

            //if we fail on anything but the first API call,
            //then we go back to the page (and probably refresh the data)
            var try_again_after_error = is_first_api_call && the_dialog.cfg.getProperty("try_again_after_error");

            var callback = CPANEL.ajax.build_callback(
                callback_success,
                {
                    current: the_dialog,
                    after_error: try_again_after_error ? the_dialog : undefined
                },
                {
                    on_error: cur_api_call.on_error,
                    whm: cur_api_call.api_application && cur_api_call.api_application === "whm",
                    keep_current_on_success: !is_last_api_call || the_dialog.cfg.getProperty("no_hide_after_success")
                }
            );

            CPANEL.api( {
                application: cur_api_call.api_application,
                module:   cur_api_call.api_module,
                func:     cur_api_call.api_function,
                api_data: cur_api_call.api_data,
                data:     data,
                callback: callback
            } );
        };

        _run_api_call_queue();
    } );

};
YAHOO.lang.extend(Common_Action_Dialog, Common_Dialog, {
    initDefaultConfig : function() {
        Common_Action_Dialog.superclass.initDefaultConfig.call(this);

        var extra_properties = [
            "header_html",
            "form_template",
            "form_template_variables",
            "clicked_element",
            "status_template",
            "api_calls",
            "preload",
            "no_hide_after_success",
            "success_function",
            "success_status",
            "success_notice_options",
            [ "try_again_after_error", true ]
        ];
        var that=this;
        extra_properties.forEach( function(p) {
            if ( p instanceof Array ) {
                that.cfg.addProperty( p[0], { value: p[1] } );
            }
            else {
                that.cfg.addProperty(p, { value: null });
            }
        } );
    },
    animated_show : function() {
        var clicked_el = this.cfg.getProperty("clicked_element");
        if ( clicked_el ) {
            var motion = this.show_from_source( clicked_el );
            return motion;
        }
        else {
            this.show();
        }
    },
    animated_cancel : function() {
        var clicked_el = this.cfg.getProperty("clicked_element");
        if ( clicked_el ) {
            var motion = this.hide_to_point( clicked_el );
            motion.onComplete.subscribe( this.cancel, this, true );
            return motion;
        }
        else {
            this.cancel();
        }
    }
});
CPANEL.ajax.Common_Action_Dialog = Common_Action_Dialog;



//make_query_string()
//
//creates an HTTP query string from a JavaScript object
CPANEL.util.make_query_string = function( data ) {
    var query_string_parts = [];
    for ( var key in data ) {
        var value = data[key];
        var encoded_key = encodeURIComponent(key);
        if ( YAHOO.lang.isArray( value ) ) {
            for ( var cv=0; cv < value.length; cv++ ) {
                query_string_parts.push( encoded_key + '=' + encodeURIComponent(value[cv]) );
            }
        }
        else {
            query_string_parts.push( encoded_key + '=' + encodeURIComponent(value) );
        }
    }

    return query_string_parts.join('&');
}



//get_data_from_form()
//
//Parses the elements in an HTML <form> element into a JavaScript object
//that represents what would be submitted on HTTP submission.
//
//opts:
//  url_instead: Return an HTTP query string instead of a JavaScript object
//  include_unchecked_checkboxes: Assigns this value to unchecked checkboxes.
//      (instead of the default, i.e. omitting unchecked checkboxes)

//fix for IE6 and IE7, which do not report the "value" attribute
//of an <option> unless it is explicitly given
var opt = document.createElement("option");
opt.innerHTML = "test";
var _option_elements_value_from_content = (opt.value !== opt.innerHTML);

CPANEL.dom.TRIM_FORM_DATA = true;
CPANEL.dom.get_data_from_form = function( form, opts ) {
    if ( typeof form === "string" ) {
        form = document.getElementById(form);
    }

    var _add_to_form_data;
    if ( opts && opts.url_instead ) {
        var form_data = [];
        _add_to_form_data = function( new_name, new_value ) {
            if ( CPANEL.dom.TRIM_FORM_DATA && typeof new_value === "string" ) {
                new_value = new_value.trim();
            }
            form_data.push( encodeURIComponent( new_name ) + '=' + encodeURIComponent( new_value ) );
        }
    }
    else {
        var form_data = {};
        _add_to_form_data = function( new_name, new_value ) {
            if ( CPANEL.dom.TRIM_FORM_DATA && typeof new_value === "string" ) {
                new_value = new_value.trim();
            }
            if ( new_name in form_data ) {
                if ( YAHOO.lang.isArray( form_data[ new_name ] ) ) {
                    form_data[ new_name ].push( new_value );
                }
                else {
                    form_data[ new_name ] = [ form_data[new_name], new_value ];
                }
            }
            else {
                form_data[ new_name ] = new_value;
            }
        }
    }

    var form_elements = form.elements;
    for ( var fc = 0, cur_control; cur_control = form_elements[ fc ]; fc++ ) {
        if ( "value" in cur_control
            && "name" in cur_control
            && cur_control.name
            && !cur_control.disabled
        ) {
            var control_name = cur_control.nodeName.toLowerCase();
            if ( control_name === "input" ) {
                var control_type = cur_control.type.toLowerCase();
                var control_form_name = cur_control.name;

                switch ( control_type ) {
                case "radio":
                    if ( cur_control.checked ) {
                        _add_to_form_data( cur_control.name, cur_control.value );
                    }
                    break;
                case "checkbox":
                    if ( cur_control.checked ) {
                        _add_to_form_data( cur_control.name, cur_control.value );
                    }
                    else if ( opts && ("include_unchecked_checkboxes" in opts) ) {
                        _add_to_form_data( cur_control.name, opts.include_unchecked_checkboxes );
                    }
                    break;
                default:
                    _add_to_form_data( cur_control.name, cur_control.value );
                    break;
                }
            }
            else if ( control_name === "select" ) {
                if ( cur_control.selectedIndex !== -1 ) {
                    var cur_control_name = cur_control.name;
                    if ( cur_control.multiple ) {
                        var cur_options = cur_control.options;
                        var cur_opt, cur_value;
                        for (var o=0; cur_opt = cur_options[o]; o++) {
                            if ( cur_opt.selected && !cur_opt.disabled ) {
                                //This only happens in IE6 and IE7 (?),
                                //so we might as well use innerText
                                //instead of CPANEL.util.get_text_content()
                                //and save a function call.
                                //We also assume hasAttribute("value"),
                                //which is safe in IE6/7.
                                if ( _option_elements_value_from_content && !cur_opt.getAttributeNode("value").specified ) {
                                    cur_value = cur_opt.innerText;
                                }
                                else {
                                    cur_value = cur_opt.value;
                                }
                                _add_to_form_data( cur_control_name, cur_value );
                            }
                        }
                    }
                    else {
                        cur_opt = cur_control.options[ cur_control.selectedIndex ];
                        //see above about IE6 and IE7
                        if ( _option_elements_value_from_content && !cur_opt.getAttributeNode("value").specified ) {
                            cur_value = cur_opt.innerText;
                        }
                        else {
                            cur_value = cur_opt.value;
                        }
                        _add_to_form_data( cur_control_name, cur_value );
                    }
                }
            }
            else if ( ( control_name === "button" ) || ( control_name === "textarea" ) ) {
                _add_to_form_data( cur_control.name, cur_control.value );
            }
        }
    }

    if ( opts && opts.url_instead ) {
        return form_data.join("&");
    }
    else {
        return form_data;
    }
};


//add_styles(), add_style()
//
//e.g. add_style( "body", "background-color:gray" ),
//     add_styles([[".foo", "color:red"], [".bar","color:blue"]])
var add_styles = function() {
    var stylesheet = document.styleSheets[0];
    if ( !stylesheet ) {
        document.head.appendChild( document.createElement("style") );
        stylesheet = document.styleSheets[0];
    }
    if ( "insertRule" in stylesheet ) {  //W3C DOM
        add_styles = function( styles ) {
            for (var s=0; s<styles.length; s++) {
                stylesheet.insertRule( styles[s][0] + " {"+styles[s][1]+"}", 0 );
            }
        };
    }
    else {  //IE
        add_styles = function( styles ) {
            for (var s=0; s<styles.length; s++) {
                stylesheet.addRule( styles[s][0], styles[s][1], 0 );
            }
        };
    }

    CPANEL.dom.add_styles = add_styles;
    return add_styles.apply( this, arguments );
}
CPANEL.dom.add_style = function(new_style) {
    return CPANEL.dom.add_styles.call(this, [new_style])
};
CPANEL.dom.add_styles = add_styles;



//smart_disable()
//
//Toggle disabled on an element such that it can "receive" a click
//to re-enable it.
var _styles_needed = !!YAHOO.env.ua.ie;
CPANEL.dom.smart_disable = function(el, to_disable, on_enable) {
    //IE needs styles added in order for smart_disable overlays to work
    if ( _styles_needed ) {
        CPANEL.dom.add_style( [
            '.cjt_smart_disable',
            'background-color:red;filter:alpha(opacity=0)'
        ] );
        _styles_needed = false;
    }

    el = DOM.get(el);
    var overlay;
    if ( to_disable === undefined ) to_disable = !el.disabled;
    if ( to_disable ) {
        if ( el._smart_disable_overlay ) return el._smart_disable_overlay;

        el.disabled = true;

        overlay = new _Smart_Disable_Overlay(el);
        overlay.render( el.parentNode );
        overlay.show();
        overlay.element.onclick = function() {
            overlay.destroy();
            try {  //IE throws an error in many cases when doing this
                delete el._smart_disable_overlay;
            } catch(e) {
                el._smart_disable_overlay = undefined;
            }
            el.disabled = false;
            if (on_enable) on_enable.apply(el);
        };
        el._smart_disable_overlay = overlay;
    }
    else {
        el.disabled = false;
        overlay = el._smart_disable_overlay;
        try {
            delete el._smart_disable_overlay;
        } catch(e) {
            el._smart_disable_overlay = undefined;
        }

        if (overlay) overlay.destroy();
    }
    return overlay;
};
var _Smart_Disable_Overlay = function(el) {
    var el_zIndex = parseFloat(CPANEL.dom.get_zindex(el));

    _Smart_Disable_Overlay.superclass.constructor.call(this, DOM.generateId(), {
        iframe: false,
        zIndex:  el_zIndex+1,
        width:   el.offsetWidth+"px",
        height:  el.offsetHeight+"px",
        context: [ el, "tl", "tl" ]
    } );

    //otherwise Mac Gecko will tab to it
    this.showEvent.subscribe( this.hideMacGeckoScrollbars, this, true );
    this.hideMacGeckoScrollbars = this.showMacGeckoScrollbars;  //blackhole it

    DOM.addClass( this.element, "cjt_smart_disable" );

    this._context_el = el;
};
YAHOO.lang.extend(_Smart_Disable_Overlay, YAHOO.widget.Overlay, {
    align : function() {
        var el_zIndex = parseFloat(CPANEL.dom.get_zindex(this._context_el));
        this.cfg.setProperty("zIndex", el_zIndex+1);
        this.cfg.setProperty("width", this._context_el.offsetWidth+"px");
        this.cfg.setProperty("height", this._context_el.offsetHeight+"px");
        _Smart_Disable_Overlay.superclass.align.apply(this,arguments);
    },
    showMacGeckoScrollbars : function() {}
} );



//get_recursive_style(), get_background_color(), get_zindex()
//
//methods for retrieving useful values instead of "auto", "transparent", etc.
CPANEL.dom.get_recursive_style = function( obj, property, recurse_if, default_value ) {
    var cur_obj = obj;
    var cur_value;

    do {
        cur_value = DOM.getComputedStyle( cur_obj, property );
    } while ( cur_value === recurse_if && (cur_obj = cur_obj.parentNode) && (cur_obj !== document) );

    if (!cur_obj) cur_value = default_value;

    return cur_value;
}
CPANEL.dom.get_background_color = function(obj) {
    return CPANEL.dom.get_recursive_style( obj, "backgroundColor", "transparent" );
}
CPANEL.dom.get_zindex = function(obj) {
    return CPANEL.dom.get_recursive_style( obj, "zIndex", "auto", 0 );
};



//class Grouped_Input_Set
//
//streamline setting up disable/enable relationships among elements groups
//that are toggled with radio buttons
//
// each group is: {
//    radio: HTMLElement, - required
//    inputs: [HTMLElement],
//    listeners: [HTMLElement] - optional, listens for click to enable
//    disablees: [HTMLElement] - optional, sets/removes "disabled" class
//}
//This also accepts (form, start_index/el, end_index/el) and will parse them.
CPANEL.ajax.Grouped_Input_Set = function() {
    var groups, first_arg = arguments[0];
    if ( (typeof first_arg === "string") || first_arg.tagName && first_arg.tagName.toLowerCase() === "form" ) {
        groups = CPANEL.ajax.Grouped_Input_Set.make_groups_from_form.apply(this,arguments);
    }
    else {
        groups = first_arg;
    }

    this._groups = groups;
    var the_set = this;
    for (var g=0; g<groups.length; g++) {
        var group = groups[g];
        YAHOO.util.Event.on( group.radio, "click", this.refresh, this, true );

        if (group.listeners) {
            (function() {
                var this_group = group;
                for (var l=0; l<this_group.listeners.length; l++) {
                    YAHOO.util.Event.on( this_group.listeners[l], "click", function() {
                        if ( !this_group.radio.checked ) {
                            this_group.radio.checked = true;
                            the_set.refresh();
                        }
                    } );
                }
            })();
        }
    }
    this.refresh();
};

var FORM_ELEMENTS = {
    button:   1,
    input:    1,
    select:   1,
    textarea: 1
};

//start_el and end_el can be elements or indexes of form.elements
CPANEL.ajax.Grouped_Input_Set.make_groups_from_form = function(form, start_el, end_el) {

    form = DOM.get(form);

    var form_labels = form.getElementsByTagName("label");
    var labels_with_for = {};
    var cur_label;
    for (var l=0; cur_label=form_labels[l]; l++) {
        if (cur_label.htmlFor) {
            labels_with_for[cur_label.htmlFor] = cur_label;
        }
    }

    //form.elements is not guaranteed to be in DOM order, e.g. WebKit 534.24
    //This also gives us an array rather than an HTML collection, which is nice.
    var els = DOM.getElementsBy(
        function(el) { return ( el.tagName.toLowerCase() in FORM_ELEMENTS ) },
        undefined,
        form
    );

    var cur_el;
    if ( typeof start_el !== "undefined" && typeof start_el !== "number" ) {
        if ( typeof start_el === "string" ) start_el = DOM.get(start_el);
        if ( start_el ) {
            var i = 0;
            while ( cur_el = els[i] && cur_el !== start_el ) i++;
            if (!cur_el) return;
            start_el = i;
        }
    }
    if (!start_el) start_el = 0;

    if ( typeof end_el !== "undefined" && typeof end_el !== "number" ) {
        if ( typeof end_el === "string" ) end_el = DOM.get(end_el);
        if ( end_el ) {
            var i = start_el || 0;
            i++;
            while ( (cur_el = els[i]) && cur_el !== end_el ) i++;
            if (!cur_el) return;
            end_el = i;
        }
    }

    var groups = [];
    var cur_group;
    for (var e=start_el; cur_el=els[e]; e++) {
        if (end_el && e>end_el) break;

        if ( cur_el.type && cur_el.type.toLowerCase() === "radio" ) {
            if ( cur_group ) {
                groups.push(cur_group);
            }
            cur_group = { radio: cur_el, inputs: [], listeners: [] };
        }
        else if (cur_group) {
            cur_group.inputs.push(cur_el);
            var label = DOM.getAncestorByTagName(cur_el,"label");

            if (!label && cur_el.id) label = labels_with_for[cur_el.id];

            if (label && (cur_group.listeners.indexOf(label) === -1)) {
                cur_group.listeners.push(label);
            }
        }
    }
    if (cur_group) groups.push(cur_group);

    return groups;
}
YAHOO.lang.augmentObject( CPANEL.ajax.Grouped_Input_Set.prototype, {
    _groups : null,
    get_groups : function() {
        return this._groups && this._groups.slice(0);
    },
    refresh : function() {
        var enabled;

        for (var g=0; g<this._groups.length; g++) {
            var group = this._groups[g];

            if ( group.radio.checked ) {
                enabled = group;
                this._enable_group(group);
            }
            else {
                this._disable_group(group);
            }
        }

        if ( this.onrefresh ) this.onrefresh.call(this,enabled);
    },

    align : function() {
        this.get_groups().forEach( function(g) {
            if (g.disabled) {
                g.smart_disable_overlays.forEach( function(o) { o.align() } );
            }
        } );
    },

    onrefresh: null,

    _enable_group : function(group) {
        if ( group.inputs ) {
            for (var i=0; i<group.inputs.length; i++) {
                CPANEL.dom.smart_disable(group.inputs[i], false);
            }
        }
        if ( group.noninputs ) {
            for (var n=0; n<group.noninputs.length; n++) {
                DOM.removeClass(group.noninputs[n], "disabled");
            }
        }
        group.disabled = false;
        group.smart_disable_overlays = null;
    },

    _disable_group : function(group) {
        var the_set = this;
        group.disabled = true;
        group.smart_disable_overlays = [];
        if ( group.inputs ) {
            var on_enable = function() {
                group.radio.checked = true;
                the_set.refresh();
                this.focus();
            };
            for (var i=0; i<group.inputs.length; i++) {
                var ov = CPANEL.dom.smart_disable(group.inputs[i], true, on_enable);
                group.smart_disable_overlays.push(ov);
            }

        }
        if ( group.noninputs ) {
            for (var n=0; n<group.noninputs.length; n++) {
                DOM.addClass(group.noninputs[n], "disabled");
            }
        }
    }
} );



//class DynamicNotice
//extends CPANEL.widgets.Notice
//
//Interactive notifications, e.g. for growl-type AJAX call success notices
//opts:
//  fade_delay: if true, # of seconds after show() to destroy()
//  closable  : whether clicking will close it (class "cjt_notice_closable")
//  closable_tooltip: tooltip text for a closable Notice element
var _notice_container;
var DynamicNotice = function(opts) {

    //YUI 2.8 has a bug with its config intialization that makes
    //this necessary for 11.30.
    if ( !opts ) {
        opts = { closable: true };
    }
    else if ( !("closable" in opts) ) {
        opts.closable = true;
    }

    DynamicNotice.superclass.constructor.call(this, opts);
};
DynamicNotice.DEFAULT_CONTAINER_ID = "cjt_dynamicnotice_container";
DynamicNotice.CLASS = "cjt_dynamicnotice";
YAHOO.lang.extend( DynamicNotice, CPANEL.widgets.Notice, {
    reset_fade_timeout : function() {
        this.config_fade_delay( this.cfg.getProperty("fade_delay") );
    },
    init : function(el, opts) {
        DynamicNotice.superclass.init.call(this, el/*, opts */);

        this.beforeInitEvent.fire(DynamicNotice);

        DOM.addClass( this.element, DynamicNotice.CLASS );

        if ( opts ) {
            this.cfg.applyConfig(opts, true);
            this.render();
        }

        this.initEvent.fire(DynamicNotice);
    },
    render : function() {
        if ( !DynamicNotice.notice_container ) {
            var notice_container = document.createElement("div");
            notice_container.id = "cjt_dynamicnotice_container";
            document.body.appendChild(notice_container);
            DynamicNotice.notice_container = notice_container;
        }

        return DynamicNotice.superclass.render.call(this, DynamicNotice.notice_container);
    },
    initDefaultConfig : function() {
        DynamicNotice.superclass.initDefaultConfig.call(this);

        this.cfg.addProperty("fade_delay", {
            value:   5,
            handler: this.config_fade_delay
        } );
        this.cfg.addProperty("closable", {
            value:   true,
            handler: this.config_closable
        } );
        this.cfg.addProperty("replaces", { value: null } );
        this.cfg.addProperty("closable_tooltip", { value: CPANEL.LANG.click_to_close } );
    },
    config_fade_delay : function(type, args, obj) {
        this._cancel_fade();

        var fade_delay = args[0];
        if (fade_delay) {
            var that = this;
            this._fade_timeout = setTimeout( function() {
                that.fade_out();
            }, fade_delay * 1000 );
        }
    },
    config_closable : function(type, args, obj) {
        var closable = args[0];
        var tooltip = this.cfg.getProperty("closable_tooltip");
        if (closable) {
            DOM.addClass( this.element, "cjt_notice_closable" );
            this._click_listener = EVENT.on( this.body, "mousedown", function(e) {
                if ( EVENT.getTarget(e).tagName.toLowerCase() !== "a" ) {
                    this.fade_out();
                }
            }, this, true );
            if ( tooltip ) {
                this._former_tooltip = this.element.title;
                this.element.title = tooltip;
            }
        }
        else {
            DOM.removeClass( this.element, "cjt_notice_closable" );
            if ( this._click_listener ) {
                YAHOO.util.Event.removeListener( this.element, "mousedown", this._click_listener );
                delete this._click_listener;
            }
            if ( tooltip && this.element.title === tooltip && ("_former_tooltip" in this) ) {
                this.element.title = this._former_tooltip;
                delete this._former_tooltip;
            }
        }
    },
    fade_out : function() {
        var fade = CPANEL.animate.fade_out(this.element);
        if (fade) {
            var that = this;
            fade.onComplete.subscribe( function() {
                that.destroy();
            } );
        }
    },
    destroy : function() {
        if ( this._fade_timeout ) {
            clearTimeout( this._fade_timeout );
            delete this._fade_timeout;
        }

        //Check to be sure the element is still in the document since
        //we have multiple things destroy()ing Notice instances, and those
        //destroy()ers are not necessarily aware of each other.
        if ( this.cfg ) {
            DynamicNotice.superclass.destroy.apply(this,arguments);
        }
    },
    _cancel_fade : function() {
        if (this._fade_timeout) {
            clearTimeout( this._fade_timeout );
            delete this._fade_timeout;
        }
    }
} );
CPANEL.ajax.DynamicNotice = DynamicNotice;


//YUI bug 2529217
//Dom.setStyle(el,"opacity","") sets opacity=0
var test_el = document.createElement("div");
if ( "filters" in test_el ) {
    YAHOO.util.Dom.setStyle(test_el,"opacity","");

    if ( !!test_el.style.filter ) {
        var ie_removeProperty = ("removeProperty" in test_el.style)
            ? "removeProperty"
            : "removeAttribute"
        ;
        var old_setStyle = YAHOO.util.Dom.setStyle;
        YAHOO.util.Dom.setStyle = function(el, attribute, val) {
            if ( attribute === "opacity" && !val && val !== 0 ) {
                el = YAHOO.util.Dom.get(el);
                var new_filter = el.style.filter.replace(/alpha\(opacity=[\d.]+\)/i,"");
                if ( new_filter ) {
                    el.style.filter = new_filter;
                }
                else {
                    el.style[ie_removeProperty]("filter");
                }
            }
            else {
                old_setStyle.apply(this,arguments);
            }
        };
    }
}

})();
