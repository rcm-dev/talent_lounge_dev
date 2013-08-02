
//--- start /usr/local/cpanel/base/cjt//compatibility.js ---
/*  
    #                                                 Copyright(c) 2010 cPanel, Inc.
    #                                                           All rights Reserved.
    # copyright@cpanel.net                                         http://cpanel.net
    # This code is subject to the cPanel license. Unauthorized copying is prohibited
*/ 

//https://developer.mozilla.org/en/Core_JavaScript_1.5_Reference/Global_Objects/Array/indexOf
if ( !('indexOf' in Array.prototype) )
{  
  Array.prototype.indexOf = function(elt /*, from*/)  
  {  
    var len = this.length >>> 0;  
  
    var from = Number(arguments[1]) || 0;  
    from = (from < 0)  
         ? Math.ceil(from)  
         : Math.floor(from);  
    if (from < 0)  
      from += len;  
  
    for (; from < len; from++)  
    {  
      if (from in this &&  
          this[from] === elt)  
        return from;  
    }  
    return -1;  
  };  
} 


//https://developer.mozilla.org/en/Core_JavaScript_1.5_Reference/Global_Objects/Array/lastIndexOf
if ( !('lastIndexOf' in Array.prototype) )
{
  Array.prototype.lastIndexOf = function(elt /*, from*/)
  {
    var len = this.length;

    var from = Number(arguments[1]);
    if (isNaN(from))
    {
      from = len - 1;
    }
    else
    {
      from = (from < 0)
           ? Math.ceil(from)
           : Math.floor(from);
      if (from < 0)
        from += len;
      else if (from >= len)
        from = len - 1;
    }

    for (; from > -1; from--)
    {
      if (from in this &&
          this[from] === elt)
        return from;
    }
    return -1;
  };
}


//https://developer.mozilla.org/en/Core_JavaScript_1.5_Reference/Global_Objects/Array/filter
if ( !('filter' in Array.prototype) )
{
  Array.prototype.filter = function(fun /*, thisp*/)
  {
    var len = this.length >>> 0;
    if (typeof fun != "function")
      throw new TypeError();

    var res = [];
    var thisp = arguments[1];
    for (var i = 0; i < len; i++)
    {
      if (i in this)
      {
        var val = this[i]; // in case fun mutates this
        if (fun.call(thisp, val, i, this))
          res.push(val);
      }
    }

    return res;
  };
}


//https://developer.mozilla.org/en/Core_JavaScript_1.5_Reference/Global_Objects/Array/forEach
if ( !('forEach' in Array.prototype) )
{
  Array.prototype.forEach = function(fun /*, thisp*/)
  {
    var len = this.length >>> 0;
    if (typeof fun != "function")
      throw new TypeError();

    var thisp = arguments[1];
    for (var i = 0; i < len; i++)
    {
      if (i in this)
        fun.call(thisp, this[i], i, this);
    }
  };
}


//https://developer.mozilla.org/en/Core_JavaScript_1.5_Reference/Global_Objects/Array/every
if ( !('every' in Array.prototype) )
{
  Array.prototype.every = function(fun /*, thisp*/)
  {
    var len = this.length >>> 0;
    if (typeof fun != "function")
      throw new TypeError();

    var thisp = arguments[1];
    for (var i = 0; i < len; i++)
    {
      if (i in this &&
          !fun.call(thisp, this[i], i, this))
        return false;
    }

    return true;
  };
}


//https://developer.mozilla.org/En/Core_JavaScript_1.5_Reference/Objects/Array/Map
if ( !('map' in Array.prototype) )
{
  Array.prototype.map = function(fun /*, thisp*/)
  {
    var len = this.length >>> 0;
    if (typeof fun != "function")
      throw new TypeError();

    var res = new Array(len);
    var thisp = arguments[1];
    for (var i = 0; i < len; i++)
    {
      if (i in this)
        res[i] = fun.call(thisp, this[i], i, this);
    }

    return res;
  };
}


//https://developer.mozilla.org/en/Core_JavaScript_1.5_Reference/Global_Objects/Array/some
if ( !('some' in Array.prototype) )
{
  Array.prototype.some = function(fun /*, thisp*/)
  {
    var i = 0,
        len = this.length >>> 0;

    if (typeof fun != "function")
      throw new TypeError();

    var thisp = arguments[1];
    for (; i < len; i++)
    {
      if (i in this &&
          fun.call(thisp, this[i], i, this))
        return true;
    }

    return false;
  };
}


//https://developer.mozilla.org/En/Core_JavaScript_1.5_Reference/Global_Objects/Array/Reduce
if ( !('reduce' in Array.prototype) )
{
  Array.prototype.reduce = function(fun /*, initial*/)
  {
    var len = this.length >>> 0;
    if (typeof fun != "function")
      throw new TypeError();

    // no value to return if no initial value and an empty array
    if (len == 0 && arguments.length == 1)
      throw new TypeError();

    var i = 0;
    if (arguments.length >= 2)
    {
      var rv = arguments[1];
    }
    else
    {
      do
      {
        if (i in this)
        {
          var rv = this[i++];
          break;
        }

        // if array contains no values, no initial value to return
        if (++i >= len)
          throw new TypeError();
      }
      while (true);
    }

    for (; i < len; i++)
    {
      if (i in this)
        rv = fun.call(null, rv, this[i], i, this);
    }

    return rv;
  };
}


//https://developer.mozilla.org/En/Core_JavaScript_1.5_Reference/Global_Objects/Array/ReduceRight
if ( !('reduceRight' in Array.prototype) )
{
  Array.prototype.reduceRight = function(fun /*, initial*/)
  {
    var len = this.length >>> 0;
    if (typeof fun != "function")
      throw new TypeError();

    // no value to return if no initial value, empty array
    if (len == 0 && arguments.length == 1)
      throw new TypeError();

    var i = len - 1;
    if (arguments.length >= 2)
    {
      var rv = arguments[1];
    }
    else
    {
      do
      {
        if (i in this)
        {
          var rv = this[i--];
          break;
        }

        // if array contains no values, no initial value to return
        if (--i < 0)
          throw new TypeError();
      }
      while (true);
    }

    for (; i >= 0; i--)
    {
      if (i in this)
        rv = fun.call(null, rv, this[i], i, this);
    }

    return rv;
  };
}



// add "trim" functionality to the String object
if ( !('trim' in String.prototype) ) {
    String.prototype.trim = function() {
    return this.replace(/^\s+|\s+$/g,"");
    }
}

//--- end /usr/local/cpanel/base/cjt//compatibility.js ---

//--- start /usr/local/cpanel/base/cjt//prototypes.js ---
//THIS FILE CONTAINS ONLY CUSTOM ADDITIONS TO BUILT-IN JAVSCRIPT PROTOTYPES.
//COMPATIBILITY FUNCTIONS TO PROTOTYPES GO IN compatibility.js.

// add html_encode functionality to the String object
if ( !('html_encode' in String.prototype) ) {
    String.prototype.html_encode = function() {
        return this
            .replace(/\&/g, "&amp;")
            .replace(/\</g, "&lt;")
            .replace(/\>/g, "&gt;")
            .replace(/\"/g, "&quot;")
            .replace(/\'/g, "&#39;")
        ;
    }
}

//COMPARABLE TO SQL SORTS: EACH ARGUMENT SPECIFIES A "TRANSFORM" FUNCTION
//THAT GENERATES A COMPARISON VALUE FOR EACH MEMBER OF THE ARRAY.
//
//OR, YOU CAN WRITE A PROPERTY OR METHOD NAME AS A STRING.
//INDICATE REVERSAL WITH A '!' AS THE FIRST CHARACTER.
//
//EXAMPLE: SORT DATES BY MONTH, BACKWARDS BY YEAR, AND SOMETHING ELSE
//BY DOING THIS:
//datesArray.sort_by('getMonth','!getYear',function (d) { ... })
//
//FOR GENERIC REVERSAL OF A TRANSFORM FUNCTION,
//DEFINE A reverse PROPERTY ON IT AS true.
Array.prototype.sort_by = function() {
    var this_length = this.length;

    var xformers = [];
    var xformers_length = arguments.length;
    for (var s=0; s<xformers_length; s++) {
        var cur_xformer = arguments[s];

        var xformer_func;
        var reverse = false;

        if (cur_xformer instanceof Function) {
            xformer_func = cur_xformer;
            reverse = cur_xformer.reverse || false;
        } else {
            reverse = ((typeof cur_xformer === "string" || cur_xformer instanceof String) && cur_xformer.charAt(0) === "!");
            if (reverse) cur_xformer = cur_xformer.substring(1);

            var referenced = this[0][cur_xformer];
            var isFunc = (referenced instanceof Function);
            xformer_func = isFunc
                ? function(i) { return i[cur_xformer]() }
                : function(i) { return i[cur_xformer] }
            ;
        }

        xformer_func.reverse_val = reverse ? -1 : 1;

        xformers.push(xformer_func);
    }

    var xformed_values = [];
    for (var i=0; i<this_length; i++) {
        cur_value = this[i];
        var cur_xformed_values = [];
        for (var x=0; x<xformers_length; x++) {
            cur_xformed_values.push( xformers[x](cur_value) );
        }
        cur_xformed_values.item = cur_value;
        xformed_values.push(cur_xformed_values);
    }

    var index, _xformers_length, first_xformed, second_xformed;
    var sorter = function(first, second) {
        index = 0;
        _xformers_length = xformers_length;  //save on scope lookups
        while (index < _xformers_length) {
            first_xformed = first[index];
            second_xformed = second[index];
            if ( first_xformed > second_xformed ) {
                return (1 * xformers[index].reverse_val);
            }
            else if ( first_xformed < second_xformed ) {
                return (-1 * xformers[index].reverse_val);
            }
            index++;
        }
        return 0;
    };

    xformed_values.sort(sorter);

    for (var xv=0; xv < this_length; xv++) {
        this[xv] = xformed_values[xv].item;
    }

    return this;
}

//--- end /usr/local/cpanel/base/cjt//prototypes.js ---

//--- start /usr/local/cpanel/base/cjt//cpanel.js ---
/*  
    #                                                 Copyright(c) 2010 cPanel, Inc.
    #                                                           All rights Reserved.
    # copyright@cpanel.net                                         http://cpanel.net
    # This code is subject to the cPanel license. Unauthorized copying is prohibited
*/ 
// YAHOO.util.Dom must be included before we can create the CPANEL object
if (typeof YAHOO.util.Dom == 'undefined' || !YAHOO.util.Dom) {
    alert('You must include the YUI Dom object before including cpanel.js!');
}

// if the CPANEL object has not already been declared
if (typeof CPANEL == "undefined" || ! CPANEL) {

	/**
		The CPANEL object is the global base object used for the whole CJT.
		It gets extended with various classes in the same manner as YUI.
		The CPANEL object requires YAHOO.util.Dom to exist before it gets created.
		@module cpanel
		@required YAHOO.util.Dom
	*/

	// TODO: re-write the logic here; we don't need the security_token on every page; can get it through location.href logic
	
	
	// figure out if we're in cPanel or WHM and set the base URLs accordingly
	var href = location.href.split('/', 5);	
	var root_path = '';
	
	/*
	if (href[3] === 'frontend') root_path = '/cPanel_magic_revision_0/frontend/' + href[4] + '/';
	else root_path = '/cPanel_magic_revision_0/';
	*/
	if (href[3] === 'frontend') {
		root_path = '/frontend/' + href[4] + '/';
	}
	else {
		root_path = '/';
	}
	

    // We always want to cache our objects forever


	/**
		The CPANEL global namespace object.  If CPANEL is already defined or YAHOO.util.Dom is not included will alert an error.
		@class CPANEL
		@static
	*/
	var CPANEL = {

        security_token : ( location.pathname.match(/^\/cpsess\d+/) || [] )[0] || "",

		/**
			The cPanel theme as defined in the URL.  ie: https://mydomain.com:2083/frontend/<u>mytheme</u>/index.html
			@property theme
			@type string
		*/
		theme : href[4],
		
		/**
			The root directory of your cPanel theme.  ie: <u>https://mydomain.com:2083/frontend/mytheme/</u>index.html
			@property frontend_root
			@type string
		*/
		frontend_root : location.protocol + "//" + location.hostname + ":" + location.port + root_path,
		
		align_panels_event : new YAHOO.util.CustomEvent("align panels event"),

        is_touchscreen : 'orientation' in window,

        has_text_content : 'textContent' in document.createElement('span'),

		JQUERY_ANIMATION_SPEED : "fast"
	};

	// include global shortcuts to Yahoo Libraries
	var DOM = YAHOO.util.Dom;
	var EVENT = YAHOO.util.Event;

} // end if statement

//--- end /usr/local/cpanel/base/cjt//cpanel.js ---

//--- start /usr/local/cpanel/base/cjt//icons.js ---
/*  
    #                                                 Copyright(c) 2010 cPanel, Inc.
    #                                                           All rights Reserved.
    # copyright@cpanel.net                                         http://cpanel.net
    # This code is subject to the cPanel license. Unauthorized copying is prohibited
*/ 

// check to be sure the CPANEL global object already exists
if (typeof CPANEL == "undefined" || !CPANEL) {
    alert('You must include the CPANEL global object before including icons.js!');
}
else {
    
/**
	The icons module contains properties that reference icons for our product.
	@module icons
*/

/**
	The icons class contains properties that reference icons for our product.
	@class icons
	@namespace CPANEL
	@extends CPANEL
*/
CPANEL.icons = {
    /** /cPanel_magic_revision_XXXXX/ is used to allow caching of images -- XXXXX needs to be incremented when the image changes **/
	
	/**
		Error icon located at cjt/images/icons/error.png
		@property error
		@type string
	*/
	error : '<img src="/cPanel_magic_revision_0/cjt/images/icons/error.png" width="16" height="16" alt="error" />',
	error_src : '/cPanel_magic_revision_0/cjt/images/icons/error.png',
		
	/**
		success icon located at cjt/images/icons/success.png
		@property success
		@type string
	*/	
	success : '<img src="/cPanel_magic_revision_0/cjt/images/icons/success.png" alt="success" width="16" height="16" />',
	success_src : '/cPanel_magic_revision_0/cjt/images/icons/success.png',

	/**
		warning icon located at cjt/images/icons/warning.png
		@property warning
		@type string
	*/	
	warning : '<img src="/cPanel_magic_revision_0/cjt/images/icons/warning.gif" alt="warning" width="16" height="16"/>',
	warning_src : '/cPanel_magic_revision_0/cjt/images/icons/warning.gif',
	
	/**
		AJAX loading icon located at cjt/images/ajax-loader.gif
		@property ajax
		@type string
	*/
	ajax : '<img src="/cPanel_magic_revision_0/cjt/images/loading.gif" alt="loading" />',
	ajax_src : '/cPanel_magic_revision_0/cjt/images/loading.gif',
	
	// /cjt/images/1px_transparent.gif
	transparent : '<img src="/cPanel_magic_revision_0/cjt/images/1px_transparent.gif" alt="" width="1" height="1"/>',
	transparent_src : '/cPanel_magic_revision_0/cjt/images/1px_transparent.gif'
	
} // end icons object
} // end else statement

//--- end /usr/local/cpanel/base/cjt//icons.js ---

//--- start /usr/local/cpanel/base/cjt//lang.js ---
/*  
    #                                                 Copyright(c) 2010 cPanel, Inc.
    #                                                           All rights Reserved.
    # copyright@cpanel.net                                         http://cpanel.net
    # This code is subject to the cPanel license. Unauthorized copying is prohibited
*/ 

// check to be sure the CPANEL global object already exists
if (typeof CPANEL == "undefined" || !CPANEL) {
    alert('You must include the CPANEL global object before including lang.js!');
}
else {
    
/**
	The lang module is used for i18n in the cjt.  It contains values in english that can be overwritten on the page.
	@module lang
*/

/**
	The lang module is used for i18n in the cjt.  It contains values in english that can be overwritten on the page.  Note: I do not include yuidoc-style comments for this section; if you want to see the phrases check the code directly.
	@class lang
	@namespace CPANEL
	@extends CPANEL
*/
CPANEL.lang = {
	
	// general purpose
	close : "close",
	Close : "Close",
	cancel : "cancel",
	unlimited : "unlimited",
	or : "or",
	ajax_loading : "loading...",	

	// create strong password dialog box
	password_generator : "Password Generator",
	generate_password : "Generate Password",
	advanced : "advanced",
	confirm_copy_password : "I have copied this password in a safe place.",
	use_password : "Use Password",
	length : "Length",
	alpha_characters : "Alpha Characters",
	nonalpha_characters : "Non Alpha Characters",
	both : "Both",
	lowercase : "Lowercase",
	uppercase : "Uppercase",
	numbers : "Numbers",
	symbols : "Symbols",
	password_strength : "Password Strength",
	passwords_match : "Passwords Match",
	password_validator_strength : "Password strength must be at least",
	password_validator_no_spaces : "Password cannot have spaces.",
	password_validator_no_empty : "Password cannot be empty.",
	password_validator_no_match : "Passwords do not match.",
	
	// validation errors modal
	Validation_Errors : "Validation Errors",

	// password bar strength phrases
	strength_phrase_very_weak : "Very Weak",
	strength_phrase_weak : "Weak",
	strength_phrase_ok : "OK",
	strength_phrase_strong : "Strong",
	strength_phrase_very_strong : "Very Strong",

	// status widget
	click_to_close : "click to close",
	
	// toggle_more_less function
	toggle_more : "more &raquo;",
	toggle_less : "less &raquo;",
	
	// generic error messages
	Error : "Error",
	json_error : "JSON Error",
	json_parse_failed : "JSON parse failed.",
	ajax_error : "AJAX Error",
	ajax_try_again : "Please refresh the page and try again.",
	
	// cjt_table
	Search: "Search",
	Simple_Search: "Simple Search",
	Advanced_Search: "Advanced Search",
	add_search_field: "add search field",
	remove: "remove",
	No_Results_Found: "No Results Found",
	Go_to: "Go to",
	Show_rows: "Show rows",
	contains: "contains",
	equals: "equals",
	More: "More",
	of : "of",
	
	// combined error messages
	ajax_error_with_image : CPANEL.icons.error + " " + this.ajax_error + ": " + this.ajax_try_again,
	json_error_with_image : CPANEL.icons.error + " " + this.json_error + ": " + this.ajax_try_again
	
} // end lang object
} // end else statement

//--- end /usr/local/cpanel/base/cjt//lang.js ---

//--- start /usr/local/cpanel/base/cjt//animate.js ---

/*
    #                                                 Copyright(c) 2010 cPanel, Inc.
    #                                                           All rights Reserved.
    # copyright@cpanel.net                                         http://cpanel.net
    # This code is subject to the cPanel license. Unauthorized copying is prohibited    
*/
// check to be sure the CPANEL global object already exists
if (typeof CPANEL == "undefined" || !CPANEL) {
    alert('You must include the CPANEL global object before including animate.js!');
}
// check to be sure the YUI Animation library exists
else if (typeof YAHOO.util.Anim == "undefined" || !YAHOO.util.Anim) {
	alert('You must include the YUI Animation library before including animate.js!');
}
else {
    
/**
	The animate module contains methods for animation.
	@module animate
*/

/**
	The animate class contains methods for animation.
	YAHOO.util.Anim must be included before using this class.  An alert will show if it is not.
	@class animate
	@namespace CPANEL
	@extends CPANEL
*/
CPANEL.animate = {
    //animate the margins, borders, paddings, and height sequentially,
    //rather than animating them concurrently;
    //concurrent slide produces an unattractive "slide within a slide" that
    //sequential slide avoids, but it's jerky on most machines/browsers in 2010.
    //Set this to true in 2012 or so. Hopefully. :)
    sequential_slide : false,

    slide_down : function(elem, callback) {
		var el = DOM.get(elem);
        var s = el.style;

        var old_position   = s.position;
        var old_visibility = s.visibility;
        var old_overflow   = s.overflow;
        var old_bottom     = s.bottom;  //See case 45653 for why this is needed.
        var old_display    = DOM.getStyle(el,'display');

        var change_overflow = old_overflow !== 'hidden';
        var change_position = old_position !== 'absolute';
        var change_visibility = old_visibility !== 'hidden';

        //guess at what kind of display to use
        var test_node = document.createElement( el.nodeName );
        test_node.style.position = 'absolute';
        test_node.style.visibility = 'hidden';
        document.body.appendChild(test_node);
        var default_display = DOM.getStyle(test_node, 'display');
        document.body.removeChild(test_node);
        delete test_node;

        if (change_visibility) s.visibility = 'hidden';
        if (change_position) s.position   = 'absolute';
        s.bottom = 0;
        if (change_overflow) s.overflow   = 'hidden';
        s.display    = default_display;

        var old_box_attrs = CPANEL.animate._get_box_attributes(el);
        var computed_box_attrs = CPANEL.animate._get_computed_box_attributes(el);

        var finish_up = function() {
            for (var attr in computed_box_attrs) {
                el.style[attr] = old_box_attrs[attr] || "";
            }

            if (change_overflow) s.overflow = old_overflow;
            if ( old_display !== 'none' ) s.display = old_display;
        };

        if (change_position) s.position   = old_position;
        s.bottom = old_bottom;
        if (change_visibility) s.visibility = old_visibility;

        for (var attr in computed_box_attrs) {
            s[attr] = 0;
        }

        if ( CPANEL.animate.sequential_slide ) {
            var total_slide_distance = 0;
            for (var attr in computed_box_attrs) total_slide_distance += computed_box_attrs[attr];

            var animations = [];
            var all_animations = CPANEL.animate._animation_order;
            var all_animations_count = CPANEL.animate._animation_order.length;
            var last_animation;
            for (var a=0; a<all_animations_count; a++) {
                var attr = all_animations[a];
                if ( attr in computed_box_attrs ) {
                    var slide_distance = computed_box_attrs[attr];
                    var slide_time = CPANEL.animate.slideTime * slide_distance / total_slide_distance;
                    var anims = {};
                    anims[attr] = { from: 0, to: computed_box_attrs[attr] };
                    var cur_anim = new YAHOO.util.Anim( el, anims, slide_time );
                    if (last_animation) {
                        ( function(frozen_anim_obj) {
                            var next_trigger = function() { frozen_anim_obj.animate() };
                            last_animation.onComplete.subscribe( next_trigger );
                        })(cur_anim);
                    }
                    animations.push(cur_anim);
                    last_animation = cur_anim;
                }
            }
            last_animation.onComplete.subscribe(finish_up);
            if (callback) last_animation.onComplete.subscribe(callback);

            animations[0].animate();

            return animations;
        }
        else {
            var animations = {};
            for (var attr in computed_box_attrs) {
                animations[attr] = { from: 0, to: computed_box_attrs[attr] };
            }

            var anim = new YAHOO.util.Anim( elem, animations, CPANEL.animate.slideTime );

            anim.onComplete.subscribe(finish_up);
            if (callback) anim.onComplete.subscribe(callback);

            anim.animate();

            return anim;
        }
    },
    slide_up : function(elem,callback) {
		var el = DOM.get(elem);
        var s = el.style;

        old_overflow = s.overflow;
        var change_overflow = old_overflow !== 'hidden';

        if (change_overflow) s.overflow = 'hidden';

        var old_box_settings = CPANEL.animate._get_box_attributes(el);
        var computed_box_settings = CPANEL.animate._get_computed_box_attributes(el);

        var finish_up = function() {
            for (var attr in computed_box_settings) {
                s[attr] = old_box_settings[attr] || "";
            }

            s.display  = 'none';
            if (change_overflow) s.overflow = old_overflow;
        };

        if ( CPANEL.animate.sequential_slide ) {
            var total_slide_distance = 0;
            for (var attr in computed_box_settings) total_slide_distance += computed_box_settings[attr];

            var animations = [];
            var all_animations = CPANEL.animate._animation_order;
            var all_animations_count = CPANEL.animate._animation_order.length;
            var last_animation;
            for (var a=all_animations_count-1; a>-1; a--) {
                var attr = all_animations[a];
                if ( attr in computed_box_settings ) {
                    var slide_distance = computed_box_settings[attr];
                    var slide_time = CPANEL.animate.slideTime * slide_distance / total_slide_distance;
                    var anims = {};
                    anims[attr] = { to: 0 };
                    var cur_anim = new YAHOO.util.Anim( el, anims, slide_time );
                    if (last_animation) {
                        ( function(frozen_anim_obj) {
                            var next_trigger = function() { frozen_anim_obj.animate() };
                            last_animation.onComplete.subscribe( next_trigger );
                        })(cur_anim);
                    }
                    animations.push(cur_anim);
                    last_animation = cur_anim;
                }
            }
            last_animation.onComplete.subscribe(finish_up);
            if (callback) last_animation.onComplete.subscribe(callback);

            animations[0].animate();

            return animations;
        }
        else {
            var animations = {};
            
            for (var attr in computed_box_settings) {
                animations[attr] = { to: 0 };
            }

            var anim = new YAHOO.util.Anim( el, animations, CPANEL.animate.slideTime );

            anim.onComplete.subscribe(finish_up);
            if (callback) anim.onComplete.subscribe(callback);
            anim.animate();

            return anim;
        }
    },

    slide_up_and_empty : function(elem,callback) {
        return CPANEL.animate.slide_up( elem, function() {
            var that=this;
            if (callback) callback.call(that);
            this.getEl().innerHTML = "";
        } );
    },
    slide_up_and_remove : function(elem,callback) {
        return CPANEL.animate.slide_up( elem, function() {
            var that=this;
            if (callback) callback.call(that);
            var el = this.getEl();
            el.parentNode.removeChild(el);
        } );
    },
    slide_toggle : function(elem,callback) {
		var el = DOM.get(elem);
        var func_name = el.offsetHeight ? 'slide_up' : 'slide_down';
        return CPANEL.animate[func_name](el,callback);
    },

    _box_attributes : {
        height:            'height',
        paddingTop:        'padding-top',
        paddingBottom:     'padding-bottom',
        borderTopWidth:    'border-top-width',
        borderBottomWidth: 'border-bottom-width',
        marginTop:         'margin-top',
        marginBottom:      'margin-bottom'
    },
    _animation_order : [ //for sliding down
        'marginTop', 'borderTopWidth', 'paddingTop',
        'height',
        'paddingBottom', 'borderBottomWidth', 'marginBottom'
    ],
    _get_box_attributes : function(el) {
        var attrs = CPANEL.util.keys(CPANEL.animate._box_attributes);
        var attrs_count = attrs.length;
        var el_box_attrs = {};
        for (var a=0; a<attrs_count; a++) {
            var cur_attr = attrs[a];
            var attr_val = el.style[ attrs[a] ];
            if ( attr_val != "" ) el_box_attrs[ cur_attr ] = attr_val;
        }
        return el_box_attrs;
    },
    _get_computed_box_attributes : function(el) {
        var computed_box_attrs = {};
        var attr_map = CPANEL.animate._box_attributes;
        for (var attr in attr_map) {
            var computed = parseFloat(DOM.getStyle(el, attr_map[attr]));
            if ( computed > 0 ) computed_box_attrs[attr] = computed;
        }

        //in case height is "auto"
        if ( !('height' in computed_box_attrs) ) {
            var simple_height = el.offsetHeight;
            if ( simple_height ) {
                for ( var attr in computed_box_attrs ) {
                    if ( attr !== 'marginTop' && attr !== 'marginBottom' ) {
                        simple_height -= computed_box_attrs[attr];
                    }
                }
                if ( simple_height ) computed_box_attrs.height = simple_height;
            }
        }
        return computed_box_attrs;
    },

    fade_in : function(elem, callback) {
        var el = DOM.get(elem);

        var old_filter = "", element_style_opacity = "";
        if ( "opacity" in el.style ) {
            element_style_opacity = el.style.opacity;
        }
        else {
            var old_filter = el.style.filter;
        }

        var target_opacity = parseFloat( DOM.getStyle(el,"opacity") );

        var anim = new YAHOO.util.Anim( el, {
            opacity: { to: target_opacity || 1 }
        }, CPANEL.animate.fadeTime );

        anim.onComplete.subscribe( function() {
            if ( "opacity" in el.style ) {
                el.style.opacity = element_style_opacity;
            }
            else if (old_filter) {
                el.style.filter = old_filter;
            }
        } );
        if ( callback ) anim.onComplete.subscribe(callback);

        DOM.setStyle(el,"opacity",0);
        el.style.visibility = "";
        if ( el.style.display === "none" ) el.style.display = "";
        anim.animate();
        return anim;
    },
    fade_out : function(elem, callback) {
        var el = DOM.get(elem);

        var old_opacity = el.style.opacity;

        var anim = new YAHOO.util.Anim( el, {
            opacity: { to: 0 }
        }, CPANEL.animate.fadeTime );

        anim.onComplete.subscribe( function() {
            el.style.display = 'none';
            el.style.opacity = old_opacity;
        } );
        if ( callback ) anim.onComplete.subscribe(callback);

        anim.animate();
        return anim;
    },
    fade_toggle : function(elem, callback) {
        var el = DOM.get(elem);
        var func_name = el.offsetHeight ? 'fade_out' : 'fade_in';
        return CPANEL.animate[func_name](el,callback);
    },

    slideTime : 0.2,
    fadeTime  : 0.32,

	/**
		Returns the browser-computed "auto" height of an element.<br />
		It calculates the height by changing the style of the element: opacity: 100%; z-index: 5000; display: block, height: auto<br />
		Then it grabs the height of the element in that state and returns the original style attributes.<br />
		This function is used by animation functions to determine the height to animate to.<br />
		NOTE: the height does NOT include padding-top or padding-bottom; only the actual height of the element
		@method getAutoHeight
		@param {DOM element} el a reference to a DOM element, will get passed to YAHOO.util.Dom.get
		@return {integer} the "auto" height of the element
	*/
	getAutoHeight : function(elid) {
		// get the element
		el = YAHOO.util.Dom.get(elid);
		
		// copy the current style
		var original_opacity = YAHOO.util.Dom.getStyle(el, 'opacity');
		var original_zindex = YAHOO.util.Dom.getStyle(el, 'z-index');
		var original_display = YAHOO.util.Dom.getStyle(el, 'display');
		var original_height = YAHOO.util.Dom.getStyle(el, 'height');
		
		// make the element invisible and expand it to it's auto height
		YAHOO.util.Dom.setStyle(el, 'opacity', 1);
		YAHOO.util.Dom.setStyle(el, 'z-index', 5000);
		YAHOO.util.Dom.setStyle(el, 'display', 'block');
		YAHOO.util.Dom.setStyle(el, 'height', 'auto');
		
		// grab the height of the element
		var currentRegion = YAHOO.util.Dom.getRegion(el);
		var padding_top = parseInt(YAHOO.util.Dom.getStyle(el, 'padding-top'));
		var padding_bottom = parseInt(YAHOO.util.Dom.getStyle(el, 'padding-bottom'));
		var currentHeight = (currentRegion.bottom - currentRegion.top - padding_top - padding_bottom);
		
		// return the original style
		var original_opacity = YAHOO.util.Dom.setStyle(el, 'opacity', original_opacity);
		var original_zindex = YAHOO.util.Dom.setStyle(el, 'z-index', original_zindex);
		var original_display = YAHOO.util.Dom.setStyle(el, 'display', original_display);
		var original_height = YAHOO.util.Dom.setStyle(el, 'height', original_height);
		
		return currentHeight;
	}

}; // end animate object


(function() {

//Workaround for YUI ticket 2529196
//This isn't a bug fix, so put it here as an enhancement
var test_panel = new YAHOO.widget.Panel();
if ( !test_panel.hasEvent('beforeShowMask') ) {
    var _initEvents = YAHOO.widget.Panel.prototype.initEvents;
    YAHOO.widget.Panel.prototype.initEvents = function() {
        _initEvents.apply(this,arguments);
        this.beforeShowMaskEvent = this.createEvent('beforeShowMask');
        this.beforeShowMaskEvent.signature = this.showMaskEvent.signature;
    };
    var _showMask = YAHOO.widget.Panel.prototype.showMask;
    YAHOO.widget.Panel.prototype.showMask = function() {
        if ( this.cfg.getProperty("modal") && this.mask ) {
            this.beforeShowMaskEvent.fire();
            _showMask.apply(this,arguments);
        }
    }
}

if ( !('ContainerEffect' in CPANEL.animate) ) {
    CPANEL.animate.ContainerEffect = {};
}
var _get_style = YAHOO.util.Dom.getStyle;
var _set_style = YAHOO.util.Dom.setStyle;
var Config = YAHOO.util.Config;

var _mask;
var _get_mask_opacity = function() {
    if ( !('_mask_opacity' in this) ) {
        _mask = this.mask;
        this._mask_opacity = _get_style( _mask, 'opacity' );
        _set_style( _mask, 'opacity', 0 );
    }
}

CPANEL.animate.ContainerEffect.FADE_MODAL = function(ovl, dur) {
    var fade = YAHOO.widget.ContainerEffect.FADE.apply(this,arguments);

    if ( !Config.alreadySubscribed( ovl.beforeShowMaskEvent, _get_mask_opacity, ovl ) ) {
        ovl.beforeShowMaskEvent.subscribe( _get_mask_opacity );
    }

    fade.animIn.onStart.subscribe( function() {
        if ( ovl.mask ) {
            var anim = new YAHOO.util.Anim( ovl.mask, { opacity: { from: 0, to: ovl._mask_opacity } }, dur );
            anim.animate();
        }
    } );
    fade.animOut.onStart.subscribe( function() {
        if ( ovl.mask ) {
            var anim = new YAHOO.util.Anim( ovl.mask, { opacity: { to: 0 } }, dur );
            anim.animate();
        }
    } );
    fade.animOut.onComplete.subscribe( function() {
        if ( ovl.mask ) {
            DOM.setStyle(ovl.mask,'opacity',0);
        }
    } );

    return fade;
};


//CPANEL.animate.Rotation
//extension of YAHOO.util.Anim
//attributes are just "from", "to", and "unit"
//not super-complete...but it works in IE :)
//
//Notable limitation: The IE code assumes the rotating object is stationary.
//It would be possible to adjust this code to accommodate objects that move
//while rotating, but it would be "jaggier" and might interfere with the
//other animation.
var _xform_attrs = ['transform','MozTransform','WebkitTransform','OTransform'];
var _dummy_el = document.createElement('span');
var _transform_attribute = _xform_attrs.filter( function(attr) { return (attr in _dummy_el.style) } );
var _transform_attribute = _transform_attribute[0] || null;
var legacy_ie_mode = _transform_attribute === null;
var ie_removeProperty = legacy_ie_mode && (
    ( 'removeProperty' in _dummy_el.style ) ? 'removeProperty' : 'removeAttribute'
);

var half_pi = .5 * Math.PI;
var pi = Math.PI;
var pi_and_half = 1.5 * Math.PI;
var two_pi = 2 * Math.PI;

var abs = Math.abs;
var sin = Math.sin;
var cos = Math.cos;

var _rotate_regexp = /rotate\(([^\)]*)\)/;
var _unit_conversions = {
    deg: { grad: 10/9, rad: Math.PI/180, deg: 1 },
    grad: { deg: 9/10, rad: Math.PI/200, grad: 1 },
    rad: { deg: 180/Math.PI, grad: 200/Math.PI, rad: 1 }
};

CPANEL.animate.Rotation = function() {
    if ( arguments[0] ) {
        arguments.callee.superclass.constructor.apply(this,arguments);

//IE necessitates a few workarounds:
//1) Since IE rotates "against the upper-left corner", move the element
//   on each rotation to where it needs to be so it looks like we rotate
//   from the center.
//2) Since IE doesn't remove an element from the normal flow when it rotates.
//   create a clone of the object, make it position:absolute, and rotate that.
//   This will produce a "jerk" if the rotation isn't to/from 0/180 degrees.
        if ( legacy_ie_mode ) {
            var el = YAHOO.util.Dom.get(arguments[0]);
            var _old_visibility;
            var _clone_el;
            var _old_position;
            var _top_style;
            var _left_style;

            this.onStart.subscribe( function() {
                _top_style = el.style.top;
                _left_style = el.style.left;

                //setting any "zoom" property forces hasLayout
                //without currentStyle.hasLayout, no filter controls display
                if ( !el.currentStyle.hasLayout ) {
                    if ( DOM.getStyle(el,"display" ) === "inline" ) {
                        el.style.display = "inline-block";
                    }
                    else {
                        el.style.zoom = "1";
                    }
                }

                //The clone is needed:
                //1. When rotating an inline element (to maintain the layout)
                //2. When not rotating from a vertical
                //...but for simplicity, this code always creates the clone.
                _clone_el = el.cloneNode(true);

                _clone_el.id = "";
                _clone_el.style.visibility = "hidden";
                _clone_el.style.position = "absolute";
                el.parentNode.insertBefore(_clone_el,el);

                if (_clone_el.style.filter) {
                    _clone_el.style.filter = "";
                }
                var region = YAHOO.util.Dom.getRegion(_clone_el);
                var width = parseFloat(YAHOO.util.Dom.getStyle(_clone_el,"width")) || region.width;
                var height = parseFloat(YAHOO.util.Dom.getStyle(_clone_el,"height")) || region.height;
                this._center_x = width / 2;
                this._center_y = height / 2;
                this._width = width;
                this._height = height;

                DOM.setXY( _clone_el, DOM.getXY( el ) );
                this._left_px = _clone_el.offsetLeft;
                this._top_px  = _clone_el.offsetTop;

                _clone_el.style.visibility = "visible";
                _clone_el.style.filter = el.style.filter;

                var z_index = YAHOO.util.Dom.getStyle(el,'z-index');
                if (z_index === "auto") z_index = 0;
                _clone_el.style.zIndex = z_index + 1;

                _old_visibility = el.style.visibility;
                el.style.visibility = "hidden";

                this.setEl(_clone_el);

                this.setRuntimeAttribute();
                var attrs = this.runtimeAttributes._rotation;
                var unit = attrs.unit;
                var degrees = (unit === 'deg')
                    ? attrs.start
                    : attrs.start * _unit_conversions[unit].deg
                ;
                var from_vertical = !(degrees % 180);
                if ( !from_vertical ) {
                    //This only returns the computed xy compensatory offset
                    //for the start angle. It does not "setAttribute".
                    var xy_offset = this.setAttribute(null,degrees,"deg",true);
                    this._left_px += xy_offset[0];
                    this._top_px  += xy_offset[1];
                }

            } );
            this.onComplete.subscribe( function() {
                //determine if we are rotating back to zero degrees,
                //which will allow a cleaner-looking image
                var attrs = this.runtimeAttributes._rotation;
                var unit = attrs.unit;
                var degrees = (unit === 'deg')
                    ? attrs.end
                    : attrs.end * _unit_conversions[unit].deg
                ;
                var to_zero = !(degrees % 360);
                var to_vertical = !(degrees % 180);

                //Sometimes IE will fail to render the element if you
                //change the "filter" property before restoring "visibility".
                //Otherwise, it normally would make sense to do this after
                //rotating and translating the source element.
                el.style.visibility = _old_visibility;

                if (to_zero) {
                    el.style[ie_removeProperty]('filter');
                }
                else {
                    el.style.filter = _clone_el.style.filter;
                }

                if ( to_vertical ) {
                    if ( _top_style ) {
                        el.style.top = _top_style;
                    }
                    else {
                        el.style[ie_removeProperty]('top');
                    }
                    if ( _left_style ) {
                        el.style.left = _left_style;
                    }
                    else {
                        el.style[ie_removeProperty]('left');
                    }
                }
                else {
                    DOM.setXY( el, DOM.getXY(_clone_el) );
                }

                _clone_el.parentNode.removeChild(_clone_el);
            } );
        }
        else if ( _transform_attribute === 'WebkitTransform' ) {
            //WebKit refuses (as of October 2010) to rotate inline elements
            this.onStart.subscribe( function() {
                var el = this.getEl();
                var original_display = YAHOO.util.Dom.getStyle(el,'display');
                if ( original_display === 'inline' ) {
                    el.style.display = 'inline-block';
                }
            } );
        }
    }
}

CPANEL.animate.Rotation.NAME = "Rotation";

YAHOO.extend(CPANEL.animate.Rotation, YAHOO.util.Anim, {

    setAttribute : function(attr,val,unit,no_set) {
        var el, el_style, cos_val, sin_val, ie_center_x, ie_center_y, width, height;
        el = this.getEl();
        el_style = el.style;

        if ( !legacy_ie_mode ) {
            el_style[_transform_attribute] = "rotate("+val+unit+")";
        }
        else {  //IE
            if ( unit !== "rad" ) {
                val = val * _unit_conversions[unit].rad;
            }
            val %= two_pi;
            if ( val < 0 ) val += two_pi;

            cos_val = cos(val);
            sin_val = sin(val);
            width = this._width;
            height = this._height;

            if ( (val >= 0 && val < half_pi) || (val >= pi && val < pi_and_half) ) {
                ie_center_x = .5 * (abs(width*cos_val) + abs(height*sin_val));
                ie_center_y = .5 * (abs(width*sin_val) + abs(height*cos_val));
            }
            else {
                ie_center_x = .5 * (abs(height*sin_val) + abs(width*cos_val));
                ie_center_y = .5 * (abs(height*cos_val) + abs(width*sin_val));
            }

            if (no_set) {
                return [ ie_center_x-this._center_x, ie_center_y-this._center_y ];
            }
            else {
                el_style.top = (this._top_px - ie_center_y + this._center_y )  + "px";
                el_style.left = (this._left_px - ie_center_x + this._center_x ) + "px";
                el_style.filter = "progid:DXImageTransform.Microsoft.Matrix(sizingMethod='auto expand',"
                    + "M11="+cos_val+","
                    + "M12="+-1*sin_val+","
                    + "M21="+sin_val+","
                    + "M22="+cos_val
                +")";
            }
        }
    },

    //the only way to get this from IE would be to parse transform values,
    //which is reeeeally icky
    getAttribute : function() {
        if ( legacy_ie_mode ) return 0;

        var match = this.getEl().style[_transform_attribute].match(_rotate_regexp);
        return match ? match[1] : 0;
    },

    defaultUnit : 'deg',

    setRuntimeAttribute : function() {
        var attr = '_rotation';
        var current_rotation;
        var unit = ( 'unit' in this.attributes ) ? this.attributes[attr].unit : this.defaultUnit;
        if ( 'from' in this.attributes ) {
            current_rotation = this.attributes.from;
        }
        else {
            current_rotation = this.getAttribute();
            if ( current_rotation ) {
                var number_units = current_rotation.match(/^(\d+)(\D+)$/);
                if ( number_units[2] === unit ) {
                    current_rotation = parseFloat(number_units[1]);
                }
                else {
                    current_rotation = number_units[1] * _unit_conversions[unit][number_units[2]];
                }
            }
        }
        this.runtimeAttributes[attr] = {
            start: current_rotation,
            end:   this.attributes.to,
            unit:  unit
        };
        return true;
    }
});


})();

} // end else statement

//--- end /usr/local/cpanel/base/cjt//animate.js ---

//--- start /usr/local/cpanel/base/cjt//array.js ---
/*  
    #                                                 Copyright(c) 2010 cPanel, Inc.
    #                                                           All rights Reserved.
    # copyright@cpanel.net                                         http://cpanel.net
    # This code is subject to the cPanel license. Unauthorized copying is prohibited
*/ 

// check to be sure the CPANEL global object already exists
if (typeof CPANEL == "undefined" || !CPANEL) {
    alert('You must include the CPANEL global object before including array.js!');
}
else {
    
/**
	The array module contains methods useful for dealing with arrays.
	@module array
*/

/**
	The array class contains methods useful for dealing with arrays.
	@class array
	@namespace CPANEL
	@extends CPANEL
*/
CPANEL.array = {
	
	/**
		Checks to see if an element exists in an array.
		@method exists
		@param {array} haystack the array
		@param {object} needle the element
		@return {boolean} true if <code>needle</code> exists in <code>haystack</code>
	*/
	exists : function(haystack, needle) {
		var len = haystack.length;
		for (var i=0; i<len; i++) {
			if (haystack[i] === needle) {
				return true;
			}
		}
		return false;
	},
	
	// this function removes all duplicate elements from an array
	// parameters: array
	// returns: array (with no duplicates)
	/**
		Removes all duplicate elements from an array.
		@method unique
		@param {array} arr the array
		@return {array} returns <code>arr</code> with no repeat elements
	*/
	unique : function(arr) {
		var arr2 = [];
		var length = arr.length;
		for(var i=0; i<length; i++) {
		  for(var j=i+1; j<length; j++) {
			if (arr[i] === arr[j]) j = ++i;
		  }
		  arr2.push(arr[i]);
		}
		return arr2;
	}
	
} // end array object
} // end else statement

//--- end /usr/local/cpanel/base/cjt//array.js ---

//--- start /usr/local/cpanel/base/cjt//color.js ---
/*
    #                                                 Copyright(c) 2010 cPanel, Inc.
    #                                                           All rights Reserved.
    # copyright@cpanel.net                                         http://cpanel.net
    # This code is subject to the cPanel license. Unauthorized copying is prohibited    
*/
// check to be sure the CPANEL global object already exists
if (typeof CPANEL == "undefined" || !CPANEL) {
    alert('You must include the CPANEL global object before including color.js!');
}
else {

/**
    Color manipulation routines
    @module color
**/

(function() {

//http://easyrgb.com/index.php?X=MATH&H=19#text19
var _hue_2_rgb = function(v1, v2, vH) {
   if ( vH < 0 ) vH += 1;
   if ( vH > 1 ) vH -= 1;
   if ( ( 6 * vH ) < 1 ) return ( v1 + ( v2 - v1 ) * 6 * vH );
   if ( ( 2 * vH ) < 1 ) return ( v2 );
   if ( ( 3 * vH ) < 2 ) return ( v1 + ( v2 - v1 ) * ( ( 2 / 3 ) - vH ) * 6 );
   return ( v1 );
};

CPANEL.color = {
    //http://easyrgb.com/index.php?X=MATH&H=19#text19
    hsl2rgb: function(h,s,l) {
        var r, g, b, var_1, var_2;
        if ( s == 0 ) {                     //HSL from 0 to 1 
            r = l * 255;                    //RGB results from 0 to 255
            g = l * 255;
            b = l * 255;
        }
        else {
            if ( l < 0.5 ) {
                var_2 = l * ( 1 + s );
            }
            else {
                var_2 = ( l + s ) - ( s * l );
            }
            var_1 = 2 * l - var_2;

            r = 255 * _hue_2_rgb( var_1, var_2, h + ( 1 / 3 ) );
            g = 255 * _hue_2_rgb( var_1, var_2, h );
            b = 255 * _hue_2_rgb( var_1, var_2, h - ( 1 / 3 ) );
        }

        return [ r, g, b ];
    }
};

})();

}

//--- end /usr/local/cpanel/base/cjt//color.js ---

//--- start /usr/local/cpanel/base/cjt//dom.js ---
/*  
    #                                                 Copyright(c) 2010 cPanel, Inc.
    #                                                           All rights Reserved.
    # copyright@cpanel.net                                         http://cpanel.net
    # This code is subject to the cPanel license. Unauthorized copying is prohibited
*/ 
if ( !('dom' in CPANEL) ) CPANEL.dom = {};

YAHOO.lang.augmentObject(CPANEL.dom, {
    get_content_region : function(el) {
        el = DOM.get(el);

        var padding_top = parseFloat(DOM.getStyle(el,"paddingTop")) || 0;
        var padding_bottom = parseFloat(DOM.getStyle(el,"paddingBottom")) || 0;
        var padding_left = parseFloat(DOM.getStyle(el,"paddingLeft")) || 0;
        var padding_right = parseFloat(DOM.getStyle(el,"paddingRight")) || 0;

        var border_left = parseFloat(DOM.getStyle(el,"borderLeftWidth")) || 0;
        var border_top  = parseFloat(DOM.getStyle(el,"borderTopWidth")) || 0;

        var xy = DOM.getXY(el);
        var top  = xy[1] + border_top  + padding_top;
        var left = xy[0] + border_left + padding_left;
        var bottom = top  + el.clientHeight - padding_top  - padding_bottom;
        var right  = left + el.clientWidth  - padding_left - padding_right;

        var region = new YAHOO.util.Region( top, right, bottom, left );
        region.outer_xy = xy;
        region.padding = {
            "top":  padding_top,
            right:  padding_right,
            bottom: padding_bottom,
            left:   padding_left
        };
        region.border = {
            "top":  border_top,
            //no bottom or right since these are unneeded here
            left:   border_left
        }
        return region;
    },
    get_content_width : function(el) {
        el = DOM.get(el);

        //most browsers return something useful from this
        var dom = parseFloat( DOM.getStyle(el, "width") );
        if ( !isNaN(dom) ) return dom;

        //IE makes us get it this way
        var padding_left = parseFloat(DOM.getStyle(el,"paddingLeft")) || 0;
        var padding_right = parseFloat(DOM.getStyle(el,"paddingRight")) || 0;

        var content_width = el.clientWidth;

        if ( content_width ) {
            return content_width - padding_left - padding_right;
        }

        var border_left = parseFloat(DOM.getStyle(el,"borderLeftWidth")) || 0;
        var border_top  = parseFloat(DOM.getStyle(el,"borderTopWidth")) || 0;
        return el.offsetWidth - padding_left - padding_right - border_left - border_right;
    },
    toggle_class : function(el, the_class) {
        el = DOM.get(el);
        if ( el.className.search(new RegExp('\\b'+the_class+'\\b')) === -1 ) {
            DOM.addClass(el,the_class);
            return the_class;
        }
        else {
            DOM.removeClass(el,the_class);
        }
    },
    toggle_classes : function(el, the_class, other_class) {
        el = DOM.get(el);
        if (el.className.search(new RegExp('\\b'+the_class+'\\b')) === -1) {
            DOM.replaceClass(el,the_class,other_class);
            return other_class;
        }
        else if (el.className.search(new RegExp('\\b'+other_class+'\\b')) === -1) {
            DOM.replaceClass(el,other_class,the_class);
            return the_class;
        }
    }
});

CPANEL.dom.get_inner_region = CPANEL.dom.get_content_region;

//--- end /usr/local/cpanel/base/cjt//dom.js ---

//--- start /usr/local/cpanel/base/cjt//dragdrop.js ---
/*  
    #                                                 Copyright(c) 2010 cPanel, Inc.
    #                                                           All rights Reserved.
    # copyright@cpanel.net                                         http://cpanel.net
    # This code is subject to the cPanel license. Unauthorized copying is prohibited
*/ 

/**
*
* A module with various drag-and-drop implementations.
* @module CPANEL.dragdrop
*
*/

// check to be sure the CPANEL global object already exists
if (typeof CPANEL == "undefined" || !CPANEL) {
    alert('You must include the CPANEL global object before including dragdrop.js!');
}
else {
    
//keep things out of global scope
( function() {

//cache variable lookups
var DDM = YAHOO.util.DragDropMgr;
var ddtarget_prototype = YAHOO.util.DDTarget.prototype;
var get = DOM.get;
var get_next_sibling = DOM.getNextSibling;
var get_xy = DOM.getXY;
var set_xy = DOM.setXY;
var get_style = DOM.getStyle;
var ease_out = YAHOO.util.Easing.easeOut;

/**
*
* This class extends DDProxy with several event handlers and
* a custom createFrame method. If you extend event handlers beyond this class,
* be sure to call DDItem's handlers, e.g.:
* DDItem.prototype.<event name>.apply(this, arguments);
* @class DDItem
* @namespace CPANEL.dragdrop
* @extends YAHOO.util.DDProxy
* @constructor
* @param {String|HTMLElement} id See parent class documentation.
* @param {String} sGroup See parent class documentation.
* @param {config} Passed to parent class constructor, and also accepts:
*                 drag_region: of type YAHOO.util.Region
*                 placeholder: an HTML Element or ID to designate as the item's placeholder
*                 animation: whether to animate DDItem interactions (default: true)
*                 animation_proxy_class: class for a DDItem animation proxy (default: _cp_animation_proxy)
*
*/
var DDItem = function( id, sGroup, config ) {
    DDItem.superclass.constructor.apply(this, arguments);

    if (!config) return;

    if ( 'drag_region' in config ) {
        var region = config.drag_region;

        var el = this.getEl();
        var xy = get_xy(el);

        if ( region.width ) {
            var width   = el.offsetWidth;
            var el_left = xy[0];
            var left    = el_left - region.left;
            var right   = region.right - el_left - width;
            this.setXConstraint(left, right);
        }

        if ( region.height ) {
            var height = el.offsetHeight;
            var el_top = xy[1];
            var top    = el_top - region.top;
            var bottom = region.bottom - el_top - height;
            this.setYConstraint(top, bottom);
        }
    }

    if ( 'placeholder' in config ) {
        var new_placeholder = get(config.placeholder);
        if ( !new_placeholder && typeof config.placeholder === "string" ) {
            new_placeholder = document.createElement('div');
            new_placeholder.id = config.placeholder;
        }

        var _placeholder_style = new_placeholder.style;

        this._placeholder = new_placeholder;
        this._placeholder_style = _placeholder_style;

        _placeholder_style.position = "absolute";
        _placeholder_style.visibility = "hidden";
        document.body.appendChild(new_placeholder);

        //put this in the prototype so it's done once then available to all class members
        this.constructor.prototype._placeholder_hidden = true;
    }

    if ('animation' in config) this._animation = config.animation;
    if ( this._animation ) {
        if ( 'animation_proxy_class' in config ) {
            this._animation_proxy_class = config.animation_proxy_class;
        }
    }
};

YAHOO.extend(DDItem, YAHOO.util.DDProxy, {
    //initial values
    _going_up: null,
    _last_y: null,

    //defaults
    _animation: true,
    _animation_proxy_class: '_cp_animation_proxy',

    _sync_placeholder: function() {
        var placeholder = this._placeholder;
        var srcEl = this.getEl();
        if ( !this._placeholder_hidden && this._animation ) {
            var motion = new YAHOO.util.Motion(
                placeholder,
                { points: { to: get_xy(srcEl) } },
                0.2
            );
            motion.animate();
        }
        else {
            set_xy( placeholder, get_xy(srcEl) );
            this._placeholder_initialized = true;
        }
        if ( this._placeholder_hidden ) {
            var _style = this._placeholder_style;
            copy_size(srcEl, placeholder, _style);
            _style.visibility = "";
            this._placeholder_hidden = false;
        }
    },

    //override the default styles in DDProxy to create just a basic div
    createFrame: function() {
        var proxy = this.getDragEl();
        if (!proxy) {
            proxy = document.createElement('div');
            proxy.id = this.dragElId;
            proxy.style.position = 'absolute';
            proxy.style.zIndex = '999';
            document.body.insertBefore(proxy,document.body.firstChild);
        }
    },

    startDrag: function(x, y) {
        // make the proxy look like the source element
        var dragEl = this.getDragEl();
        var clickEl = this.getEl();

        dragEl.innerHTML = clickEl.innerHTML;
        clickEl.style.visibility = "hidden";
        if ( '_placeholder' in this ) {
            this._sync_placeholder();
        }
    },

    endDrag: function(e) {
        var srcEl = this.getEl();
        var proxy = this.getDragEl();
        var proxy_style = proxy.style;

        // Show the proxy element and animate it to the src element's location
        proxy_style.visibility = "";
        var a = new YAHOO.util.Motion(
            proxy,
            { points: { to: get_xy(srcEl) } },
            0.2,
            ease_out
        );

        var that = this;

        // Hide the proxy and show the source element when finished with the animation
        a.onComplete.subscribe(function() {
                proxy_style.visibility = "hidden";
                srcEl.style.visibility = "";

                if ( '_placeholder' in that ) {
                    that._placeholder_style.visibility = "hidden";
                    that._placeholder_hidden = true;
                }
            });
        a.animate();
    },

    onDrag: function(e) {
        // Keep track of the direction of the drag for use during onDragOver
        var y = EVENT.getPageY(e);
        var last_y = this._last_y;

        if (y < last_y) {
            this._going_up = true;
        }
        else if (y > last_y) {
            this._going_up = false;
        }
        else {
            this._going_up = null;
        }

        this._last_y = y;
    },

    //detect a new parent element
    onDragEnter: function(e, id) {
        if ( this.parent_id === null ) {
            var srcEl = this.getEl();
            var destEl = get(id);

            this.parent_id = id;

            if ( this.last_parent !== id ) {
                destEl.appendChild(srcEl);
            }

            if ( 'placeholder' in this ) {
                this._sync_placeholder();
            }
        }
    },

    onDragOut: function(e, id) {
        if ( this.getEl().parentNode === get(id) ) {
            this.last_parent = id;
            this.parent_id = null;
        }
    },

    onDragOver: function(e, id) {
        var srcEl = this.getEl();
        var destEl = get(id);

        //we don't care about horizontal motion here
        var going_up = this._going_up;
        if (going_up === null) return;

        //We are only concerned with draggable items, not containers
        var is_container = ddtarget_prototype.isPrototypeOf( DDM.getDDById(id) );
        if (is_container) return;

        var parent_el = destEl.parentNode;

        //When drag-dropping between targets, sometimes the srcEl is inserted
        //below the destEl when the mouse is going down.
        //The result is that the srcEl keeps being re-inserted and re-inserted.
        //Weed this case out.
        var next_after_dest = get_next_sibling(destEl);
        var dest_then_src = (next_after_dest === srcEl);
        if ( !going_up && dest_then_src ) return;

        if ( this._animation ) {
            //similar check to the above;
            //this only seems to happen when there is animation
            var src_then_dest = (get_next_sibling(srcEl) === destEl);
            if ( going_up && src_then_dest ) return;

            //only animate adjacent drags
            if ( src_then_dest || dest_then_src ) {
                dp_parent = document.body;

                var dest_proxy = document.createElement('div');
                dest_proxy.className = this._animation_proxy_class;
                var dp_style = dest_proxy.style;

                dp_style.position = 'absolute';
                dp_style.display = 'none';
                dest_proxy.innerHTML = destEl.innerHTML;
                copy_size( destEl, dest_proxy, dp_style );
                dp_parent.appendChild(dest_proxy);

                var dest_proxy_motion_destination = get_xy(srcEl);
                var height_difference = parseFloat(get_style(dest_proxy,'height')) - parseFloat(get_style(srcEl,'height'));
                if ( going_up ) {
                    dest_proxy_motion_destination[1] -= height_difference;
                }

                var attrs = { points: {
                    from: get_xy(destEl),
                    to: dest_proxy_motion_destination
                } };
                var anim = new YAHOO.util.Motion(dest_proxy, attrs, 0.25);

                var de_style = destEl.style;
                anim.onComplete.subscribe(function() {
                    de_style.visibility = "";
                    dp_parent.removeChild(dest_proxy);
                });

                dp_style.display = "";
                de_style.visibility = "hidden";
                anim.animate();
            }
        }

        if (going_up) {
            parent_el.insertBefore(srcEl, destEl); // insert above
        } else {
            parent_el.insertBefore(srcEl, next_after_dest); // insert below
        }

        if ( '_placeholder' in this ) {
            this._sync_placeholder();
        }

        DDM.refreshCache();
    }
});

//pass in the style as a parameter to save a lookup
var copy_size = function(src, dest, dest_style) {
    var br = parseFloat(get_style(dest,'border-right-width')) || 0;
    var bl = parseFloat(get_style(dest,'border-left-width')) || 0;
    var newWidth  = Math.max(0, src.offsetWidth - br - bl);

    var bt = parseFloat(get_style(dest,'border-top-width')) || 0;
    var bb = parseFloat(get_style(dest,'border-bottom-width')) || 0;
    var newHeight = Math.max(0, src.offsetHeight - bt - bb);

    dest_style.width = newWidth  + "px";
    dest_style.height = newHeight + "px";
};

CPANEL.dragdrop = {
/**
*
* This method returns an object of "items" that can be drag-dropped
* among the object's "containers".
* @method containers
* @namespace CPANEL.dragdrop
* @param { Array | HTMLElement } containers Either a single HTML container (div, ul, etc.) or an array of containers to initialize as YAHOO.util.DDTarget objects and whose "children" will be initialized as CPANEL.dragdrop.DDItem objects.
* @param { String } group The DragDrop group to use in initializing the containers and items.
* @param { object } config Options for YAHOO.util.DDTarget and CPANEL.dragdrop.DDItem constructors; accepts:
*                   item_constructor: function to use for creating the item objects (probably override DDItem)
*
*/
    containers : function( containers, group, config ) {
        if ( !(containers instanceof Array) ) {
            containers = [containers];
        }

        var container_objects = [];
        var drag_item_objects = [];

        var item_constructor = (config && config.item_constructor) || DDItem;

        var containers_length = containers.length;
        for (var c=0; c<containers_length; c++) {
            var cur_container = get(containers[c]);
            container_objects.push( new YAHOO.util.DDTarget(cur_container, group, config) );

            var cur_contents = cur_container.children;
            var cur_contents_length = cur_contents.length;
            for (var i=0; i<cur_contents_length; i++) {
                drag_item_objects.push( new item_constructor(cur_contents[i], group, config) );
            }
        }

        return { containers: container_objects, items: drag_item_objects };
    },
    DDItem : DDItem
};

})();

} // end else statement

//--- end /usr/local/cpanel/base/cjt//dragdrop.js ---

//--- start /usr/local/cpanel/base/cjt//fixes.js ---
/*
if (YAHOO.VERSION != '2.8.1') {
   alert('YUI version change.   Please have UI Development look at cpanel.js');
   //    yui/datatable/datatable.js
   //    http://yuilibrary.com/projects/yui2/ticket/2529068
   //    Ensure this bug has been fixed in the new version of YUI
}

*/


(function() {

var L = YAHOO.lang;

//YUI bug 2529100
if (YAHOO.lang.substitute("{a} {b}", {a:"1",b:"{"}) !== "1 {") {
    YAHOO.lang.substitute = function (s, o, f) {
        var i, j, k, key, v, meta, saved=[], token, 
            DUMP='dump', SPACE=' ', LBRACE='{', RBRACE='}',
            dump, objstr;

        for (;;) {
            i = i ? s.lastIndexOf(LBRACE, i-1) : s.lastIndexOf(LBRACE);
            if (i < 0) {
                break;
            }
            j = s.indexOf(RBRACE, i);
            if (i + 1 >= j) {
                break;
            }

            //Extract key and meta info 
            token = s.substring(i + 1, j);
            key = token;
            meta = null;
            k = key.indexOf(SPACE);
            if (k > -1) {
                meta = key.substring(k + 1);
                key = key.substring(0, k);
            }

            // lookup the value
            // if a substitution function was provided, execute it
            v = f ? f(key, v, meta) : o[key];

            if (L.isObject(v)) {
                if (L.isArray(v)) {
                    v = L.dump(v, parseInt(meta, 10));
                } else {
                    meta = meta || "";

                    // look for the keyword 'dump', if found force obj dump
                    dump = meta.indexOf(DUMP);
                    if (dump > -1) {
                        meta = meta.substring(4);
                    }

                    objstr = v.toString();

                    // use the toString if it is not the Object toString 
                    // and the 'dump' meta info was not found
                    if (objstr === OBJECT_TOSTRING || dump > -1) {
                        v = L.dump(v, parseInt(meta, 10));
                    } else {
                        v = objstr;
                    }
                }
            } else if (!L.isString(v) && !L.isNumber(v)) {
                continue;
//unnecessary with fix for YUI bug 2529100
//                // This {block} has no replace string. Save it for later.
//                v = "~-" + saved.length + "-~";
//                saved[saved.length] = token;
//
//                // break;
            }

            s = s.substring(0, i) + v + s.substring(j + 1);

        }

//unnecessary with fix for YUI bug 2529100
//        // restore saved {block}s
//        for (i=saved.length-1; i>=0; i=i-1) {
//            s = s.replace(new RegExp("~-" + i + "-~"), "{"  + saved[i] + "}", "g");
//        }

        return s;
    };
}

//YUI bug 2529183
//There is no easy way to test if this is still a problem,
//but an arity check will at least make sure this workaround runs only once.
if ( !YAHOO.util.AnimMgr._2529183_fixed ) {
    var _unregister_queue = [];
    var _unregistering = false;
    var _do_unregister = YAHOO.util.AnimMgr.unRegister;

    var _run_unregister_queue = function() {
        var next_args = _unregister_queue.shift();
        _do_unregister.apply(YAHOO.util.AnimMgr,next_args);
        if ( _unregister_queue.length > 0 ) arguments.callee();
    };

    YAHOO.util.AnimMgr.unRegister = function() {
        _unregister_queue.push(arguments);
        if ( !_unregistering ) {
            _unregistering = true;
            _run_unregister_queue();
            _unregistering = false;
        }
    }
    YAHOO.util.AnimMgr._2529183_fixed = true;
}

//YUI 2 bug 2529256: avoid focusing unchecked radio buttons in tab loop
//Strictly speaking, this should be fixed for focusLast as well,
//but the usefulness of that seems questionable.
//This runs the original focusFirst() method then advances the focus to
//the next non-enabled-unchecked-radio focusable element if necessary.
if ( !YAHOO.widget.Panel.prototype.focusFirst._2529256_fixed ) {
    var _focus_first = YAHOO.widget.Panel.prototype.focusFirst;
    YAHOO.widget.Panel.prototype.focusFirst = function() {
        _focus_first.apply(this,arguments);

        var focused_el = document.activeElement;
        if (focused_el) {
            var els = this.focusableElements;
            var i = els.indexOf(focused_el);
            if (i !== -1) {
                if (!focused_el.checked && (focused_el.tagName.toLowerCase() === "input") && (focused_el.type.toLowerCase() === "radio") ) {
                    i++;
                    var cur_el;
                    while ( cur_el = els[i] ) {
                        if (!cur_el.disabled && ((cur_el.tagName.toLowerCase() !== "input") || (cur_el.type.toLowerCase() !== "radio") || cur_el.checked)) break;
                        i++;
                    }
                    if ( i !== els.length && cur_el && cur_el.focus ) cur_el.focus();
                }
            }
        }
    };
    YAHOO.widget.Panel.prototype.focusFirst._2529256_fixed = true;

    //For cPanel & WHM 11.30 since the YUI 2.9.0 upgrade is deferred to 11.32.
    YAHOO.widget.Dialog.prototype.focusFirst = YAHOO.widget.Panel.prototype.focusFirst;
}

//YUI 2 bug 2529257: prevent back-TAB from escaping focus out of a modal Panel
var _set_first_last_focusable = YAHOO.widget.Panel.prototype.setFirstLastFocusable;

var catcher_html = "<input style='position:absolute;top:1px;outline:0;margin:0;border:0;padding:0;height:1px;width:1px;z-index:-1' />";
var _catcher_div = document.createElement("div");
_catcher_div.innerHTML = catcher_html;
var catcher_prototype = _catcher_div.firstChild;
DOM.setStyle(catcher_prototype,"opacity",0);

YAHOO.widget.Panel.prototype.setFirstLastFocusable = function() {
    _set_first_last_focusable.apply(this,arguments);

    if ( this.firstElement && !this._first_focusable_catcher ) {
        var first_catcher = catcher_prototype.cloneNode(false);
        YAHOO.util.Event.on( first_catcher, "focus", function() {
            first_catcher.blur();
            this.focusLast();
        }, this, true );
        this.innerElement.insertBefore( first_catcher, this.innerElement.firstChild );
        this._first_focusable_catcher = first_catcher;

        var last_catcher = catcher_prototype.cloneNode(false);
        YAHOO.util.Event.on( last_catcher, "focus", function() {
            last_catcher.blur();
            this.focusFirst();
        }, this, true );
        this.innerElement.appendChild( last_catcher );
        this._last_focusable_catcher = last_catcher;
    }
};

//YUI 2 bug #2529283: Dialog should prefer given lastElement to this.lastButton
var Dialog = YAHOO.widget.Dialog;
YAHOO.widget.Dialog.prototype.setTabLoop = function(firstElement, lastElement) {
    firstElement = firstElement || this.firstButton;
    lastElement  = lastElement  || this.lastButton;

    Dialog.superclass.setTabLoop.call(this, firstElement, lastElement);
}

//YUI 2 bug #2529284: Dialog focusLast() needs to be aware of close (x) buttons
var _focusLast = YAHOO.widget.Dialog.prototype.focusLast;
Dialog.prototype.focusLast = function() {
    //Call this first since it does some event handling stuff.
    _focusLast.apply(this,arguments);

    if ( this.close && this.close === this.lastElement ) {
        this.close.focus();
    }
};

var _get_focusable_elements = YAHOO.widget.Panel.prototype.getFocusableElements;
YAHOO.widget.Panel.prototype.getFocusableElements = function() {
    var els = _get_focusable_elements.apply(this,arguments);

    //An element that has display:none is not focusable.
    for (var i=0, cur_el; cur_el = els[i]; i++) {
        if (DOM.getStyle(cur_el,"display") === "none") {
            els.splice(i,1);
            i--;
        }
    }

    if (els.length) {
        if (this._first_focusable_catcher) els.shift();
        if (this._last_focusable_catcher) els.pop();
    }

    return els;
};

})();

//--- end /usr/local/cpanel/base/cjt//fixes.js ---

//--- start /usr/local/cpanel/base/cjt//jquery.js ---
/*!
 * jQuery JavaScript Library v1.4.2
 * http://jquery.com/
 *
 * Copyright 2010, John Resig
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * Includes Sizzle.js
 * http://sizzlejs.com/
 * Copyright 2010, The Dojo Foundation
 * Released under the MIT, BSD, and GPL Licenses.
 *
 * Date: Sat Feb 13 22:33:48 2010 -0500
 */
(function(A,w){function ma(){if(!c.isReady){try{s.documentElement.doScroll("left")}catch(a){setTimeout(ma,1);return}c.ready()}}function Qa(a,b){b.src?c.ajax({url:b.src,async:false,dataType:"script"}):c.globalEval(b.text||b.textContent||b.innerHTML||"");b.parentNode&&b.parentNode.removeChild(b)}function X(a,b,d,f,e,j){var i=a.length;if(typeof b==="object"){for(var o in b)X(a,o,b[o],f,e,d);return a}if(d!==w){f=!j&&f&&c.isFunction(d);for(o=0;o<i;o++)e(a[o],b,f?d.call(a[o],o,e(a[o],b)):d,j);return a}return i?
e(a[0],b):w}function J(){return(new Date).getTime()}function Y(){return false}function Z(){return true}function na(a,b,d){d[0].type=a;return c.event.handle.apply(b,d)}function oa(a){var b,d=[],f=[],e=arguments,j,i,o,k,n,r;i=c.data(this,"events");if(!(a.liveFired===this||!i||!i.live||a.button&&a.type==="click")){a.liveFired=this;var u=i.live.slice(0);for(k=0;k<u.length;k++){i=u[k];i.origType.replace(O,"")===a.type?f.push(i.selector):u.splice(k--,1)}j=c(a.target).closest(f,a.currentTarget);n=0;for(r=
j.length;n<r;n++)for(k=0;k<u.length;k++){i=u[k];if(j[n].selector===i.selector){o=j[n].elem;f=null;if(i.preType==="mouseenter"||i.preType==="mouseleave")f=c(a.relatedTarget).closest(i.selector)[0];if(!f||f!==o)d.push({elem:o,handleObj:i})}}n=0;for(r=d.length;n<r;n++){j=d[n];a.currentTarget=j.elem;a.data=j.handleObj.data;a.handleObj=j.handleObj;if(j.handleObj.origHandler.apply(j.elem,e)===false){b=false;break}}return b}}function pa(a,b){return"live."+(a&&a!=="*"?a+".":"")+b.replace(/\./g,"`").replace(/ /g,
"&")}function qa(a){return!a||!a.parentNode||a.parentNode.nodeType===11}function ra(a,b){var d=0;b.each(function(){if(this.nodeName===(a[d]&&a[d].nodeName)){var f=c.data(a[d++]),e=c.data(this,f);if(f=f&&f.events){delete e.handle;e.events={};for(var j in f)for(var i in f[j])c.event.add(this,j,f[j][i],f[j][i].data)}}})}function sa(a,b,d){var f,e,j;b=b&&b[0]?b[0].ownerDocument||b[0]:s;if(a.length===1&&typeof a[0]==="string"&&a[0].length<512&&b===s&&!ta.test(a[0])&&(c.support.checkClone||!ua.test(a[0]))){e=
true;if(j=c.fragments[a[0]])if(j!==1)f=j}if(!f){f=b.createDocumentFragment();c.clean(a,b,f,d)}if(e)c.fragments[a[0]]=j?f:1;return{fragment:f,cacheable:e}}function K(a,b){var d={};c.each(va.concat.apply([],va.slice(0,b)),function(){d[this]=a});return d}function wa(a){return"scrollTo"in a&&a.document?a:a.nodeType===9?a.defaultView||a.parentWindow:false}var c=function(a,b){return new c.fn.init(a,b)},Ra=A.jQuery,Sa=A.$,s=A.document,T,Ta=/^[^<]*(<[\w\W]+>)[^>]*$|^#([\w-]+)$/,Ua=/^.[^:#\[\.,]*$/,Va=/\S/,
Wa=/^(\s|\u00A0)+|(\s|\u00A0)+$/g,Xa=/^<(\w+)\s*\/?>(?:<\/\1>)?$/,P=navigator.userAgent,xa=false,Q=[],L,$=Object.prototype.toString,aa=Object.prototype.hasOwnProperty,ba=Array.prototype.push,R=Array.prototype.slice,ya=Array.prototype.indexOf;c.fn=c.prototype={init:function(a,b){var d,f;if(!a)return this;if(a.nodeType){this.context=this[0]=a;this.length=1;return this}if(a==="body"&&!b){this.context=s;this[0]=s.body;this.selector="body";this.length=1;return this}if(typeof a==="string")if((d=Ta.exec(a))&&
(d[1]||!b))if(d[1]){f=b?b.ownerDocument||b:s;if(a=Xa.exec(a))if(c.isPlainObject(b)){a=[s.createElement(a[1])];c.fn.attr.call(a,b,true)}else a=[f.createElement(a[1])];else{a=sa([d[1]],[f]);a=(a.cacheable?a.fragment.cloneNode(true):a.fragment).childNodes}return c.merge(this,a)}else{if(b=s.getElementById(d[2])){if(b.id!==d[2])return T.find(a);this.length=1;this[0]=b}this.context=s;this.selector=a;return this}else if(!b&&/^\w+$/.test(a)){this.selector=a;this.context=s;a=s.getElementsByTagName(a);return c.merge(this,
a)}else return!b||b.jquery?(b||T).find(a):c(b).find(a);else if(c.isFunction(a))return T.ready(a);if(a.selector!==w){this.selector=a.selector;this.context=a.context}return c.makeArray(a,this)},selector:"",jquery:"1.4.2",length:0,size:function(){return this.length},toArray:function(){return R.call(this,0)},get:function(a){return a==null?this.toArray():a<0?this.slice(a)[0]:this[a]},pushStack:function(a,b,d){var f=c();c.isArray(a)?ba.apply(f,a):c.merge(f,a);f.prevObject=this;f.context=this.context;if(b===
"find")f.selector=this.selector+(this.selector?" ":"")+d;else if(b)f.selector=this.selector+"."+b+"("+d+")";return f},each:function(a,b){return c.each(this,a,b)},ready:function(a){c.bindReady();if(c.isReady)a.call(s,c);else Q&&Q.push(a);return this},eq:function(a){return a===-1?this.slice(a):this.slice(a,+a+1)},first:function(){return this.eq(0)},last:function(){return this.eq(-1)},slice:function(){return this.pushStack(R.apply(this,arguments),"slice",R.call(arguments).join(","))},map:function(a){return this.pushStack(c.map(this,
function(b,d){return a.call(b,d,b)}))},end:function(){return this.prevObject||c(null)},push:ba,sort:[].sort,splice:[].splice};c.fn.init.prototype=c.fn;c.extend=c.fn.extend=function(){var a=arguments[0]||{},b=1,d=arguments.length,f=false,e,j,i,o;if(typeof a==="boolean"){f=a;a=arguments[1]||{};b=2}if(typeof a!=="object"&&!c.isFunction(a))a={};if(d===b){a=this;--b}for(;b<d;b++)if((e=arguments[b])!=null)for(j in e){i=a[j];o=e[j];if(a!==o)if(f&&o&&(c.isPlainObject(o)||c.isArray(o))){i=i&&(c.isPlainObject(i)||
c.isArray(i))?i:c.isArray(o)?[]:{};a[j]=c.extend(f,i,o)}else if(o!==w)a[j]=o}return a};c.extend({noConflict:function(a){A.$=Sa;if(a)A.jQuery=Ra;return c},isReady:false,ready:function(){if(!c.isReady){if(!s.body)return setTimeout(c.ready,13);c.isReady=true;if(Q){for(var a,b=0;a=Q[b++];)a.call(s,c);Q=null}c.fn.triggerHandler&&c(s).triggerHandler("ready")}},bindReady:function(){if(!xa){xa=true;if(s.readyState==="complete")return c.ready();if(s.addEventListener){s.addEventListener("DOMContentLoaded",
L,false);A.addEventListener("load",c.ready,false)}else if(s.attachEvent){s.attachEvent("onreadystatechange",L);A.attachEvent("onload",c.ready);var a=false;try{a=A.frameElement==null}catch(b){}s.documentElement.doScroll&&a&&ma()}}},isFunction:function(a){return $.call(a)==="[object Function]"},isArray:function(a){return $.call(a)==="[object Array]"},isPlainObject:function(a){if(!a||$.call(a)!=="[object Object]"||a.nodeType||a.setInterval)return false;if(a.constructor&&!aa.call(a,"constructor")&&!aa.call(a.constructor.prototype,
"isPrototypeOf"))return false;var b;for(b in a);return b===w||aa.call(a,b)},isEmptyObject:function(a){for(var b in a)return false;return true},error:function(a){throw a;},parseJSON:function(a){if(typeof a!=="string"||!a)return null;a=c.trim(a);if(/^[\],:{}\s]*$/.test(a.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,"@").replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,"]").replace(/(?:^|:|,)(?:\s*\[)+/g,"")))return A.JSON&&A.JSON.parse?A.JSON.parse(a):(new Function("return "+
a))();else c.error("Invalid JSON: "+a)},noop:function(){},globalEval:function(a){if(a&&Va.test(a)){var b=s.getElementsByTagName("head")[0]||s.documentElement,d=s.createElement("script");d.type="text/javascript";if(c.support.scriptEval)d.appendChild(s.createTextNode(a));else d.text=a;b.insertBefore(d,b.firstChild);b.removeChild(d)}},nodeName:function(a,b){return a.nodeName&&a.nodeName.toUpperCase()===b.toUpperCase()},each:function(a,b,d){var f,e=0,j=a.length,i=j===w||c.isFunction(a);if(d)if(i)for(f in a){if(b.apply(a[f],
d)===false)break}else for(;e<j;){if(b.apply(a[e++],d)===false)break}else if(i)for(f in a){if(b.call(a[f],f,a[f])===false)break}else for(d=a[0];e<j&&b.call(d,e,d)!==false;d=a[++e]);return a},trim:function(a){return(a||"").replace(Wa,"")},makeArray:function(a,b){b=b||[];if(a!=null)a.length==null||typeof a==="string"||c.isFunction(a)||typeof a!=="function"&&a.setInterval?ba.call(b,a):c.merge(b,a);return b},inArray:function(a,b){if(b.indexOf)return b.indexOf(a);for(var d=0,f=b.length;d<f;d++)if(b[d]===
a)return d;return-1},merge:function(a,b){var d=a.length,f=0;if(typeof b.length==="number")for(var e=b.length;f<e;f++)a[d++]=b[f];else for(;b[f]!==w;)a[d++]=b[f++];a.length=d;return a},grep:function(a,b,d){for(var f=[],e=0,j=a.length;e<j;e++)!d!==!b(a[e],e)&&f.push(a[e]);return f},map:function(a,b,d){for(var f=[],e,j=0,i=a.length;j<i;j++){e=b(a[j],j,d);if(e!=null)f[f.length]=e}return f.concat.apply([],f)},guid:1,proxy:function(a,b,d){if(arguments.length===2)if(typeof b==="string"){d=a;a=d[b];b=w}else if(b&&
!c.isFunction(b)){d=b;b=w}if(!b&&a)b=function(){return a.apply(d||this,arguments)};if(a)b.guid=a.guid=a.guid||b.guid||c.guid++;return b},uaMatch:function(a){a=a.toLowerCase();a=/(webkit)[ \/]([\w.]+)/.exec(a)||/(opera)(?:.*version)?[ \/]([\w.]+)/.exec(a)||/(msie) ([\w.]+)/.exec(a)||!/compatible/.test(a)&&/(mozilla)(?:.*? rv:([\w.]+))?/.exec(a)||[];return{browser:a[1]||"",version:a[2]||"0"}},browser:{}});P=c.uaMatch(P);if(P.browser){c.browser[P.browser]=true;c.browser.version=P.version}if(c.browser.webkit)c.browser.safari=
true;if(ya)c.inArray=function(a,b){return ya.call(b,a)};T=c(s);if(s.addEventListener)L=function(){s.removeEventListener("DOMContentLoaded",L,false);c.ready()};else if(s.attachEvent)L=function(){if(s.readyState==="complete"){s.detachEvent("onreadystatechange",L);c.ready()}};(function(){c.support={};var a=s.documentElement,b=s.createElement("script"),d=s.createElement("div"),f="script"+J();d.style.display="none";d.innerHTML="   <link/><table></table><a href='/a' style='color:red;float:left;opacity:.55;'>a</a><input type='checkbox'/>";
var e=d.getElementsByTagName("*"),j=d.getElementsByTagName("a")[0];if(!(!e||!e.length||!j)){c.support={leadingWhitespace:d.firstChild.nodeType===3,tbody:!d.getElementsByTagName("tbody").length,htmlSerialize:!!d.getElementsByTagName("link").length,style:/red/.test(j.getAttribute("style")),hrefNormalized:j.getAttribute("href")==="/a",opacity:/^0.55$/.test(j.style.opacity),cssFloat:!!j.style.cssFloat,checkOn:d.getElementsByTagName("input")[0].value==="on",optSelected:s.createElement("select").appendChild(s.createElement("option")).selected,
parentNode:d.removeChild(d.appendChild(s.createElement("div"))).parentNode===null,deleteExpando:true,checkClone:false,scriptEval:false,noCloneEvent:true,boxModel:null};b.type="text/javascript";try{b.appendChild(s.createTextNode("window."+f+"=1;"))}catch(i){}a.insertBefore(b,a.firstChild);if(A[f]){c.support.scriptEval=true;delete A[f]}try{delete b.test}catch(o){c.support.deleteExpando=false}a.removeChild(b);if(d.attachEvent&&d.fireEvent){d.attachEvent("onclick",function k(){c.support.noCloneEvent=
false;d.detachEvent("onclick",k)});d.cloneNode(true).fireEvent("onclick")}d=s.createElement("div");d.innerHTML="<input type='radio' name='radiotest' checked='checked'/>";a=s.createDocumentFragment();a.appendChild(d.firstChild);c.support.checkClone=a.cloneNode(true).cloneNode(true).lastChild.checked;c(function(){var k=s.createElement("div");k.style.width=k.style.paddingLeft="1px";s.body.appendChild(k);c.boxModel=c.support.boxModel=k.offsetWidth===2;s.body.removeChild(k).style.display="none"});a=function(k){var n=
s.createElement("div");k="on"+k;var r=k in n;if(!r){n.setAttribute(k,"return;");r=typeof n[k]==="function"}return r};c.support.submitBubbles=a("submit");c.support.changeBubbles=a("change");a=b=d=e=j=null}})();c.props={"for":"htmlFor","class":"className",readonly:"readOnly",maxlength:"maxLength",cellspacing:"cellSpacing",rowspan:"rowSpan",colspan:"colSpan",tabindex:"tabIndex",usemap:"useMap",frameborder:"frameBorder"};var G="jQuery"+J(),Ya=0,za={};c.extend({cache:{},expando:G,noData:{embed:true,object:true,
applet:true},data:function(a,b,d){if(!(a.nodeName&&c.noData[a.nodeName.toLowerCase()])){a=a==A?za:a;var f=a[G],e=c.cache;if(!f&&typeof b==="string"&&d===w)return null;f||(f=++Ya);if(typeof b==="object"){a[G]=f;e[f]=c.extend(true,{},b)}else if(!e[f]){a[G]=f;e[f]={}}a=e[f];if(d!==w)a[b]=d;return typeof b==="string"?a[b]:a}},removeData:function(a,b){if(!(a.nodeName&&c.noData[a.nodeName.toLowerCase()])){a=a==A?za:a;var d=a[G],f=c.cache,e=f[d];if(b){if(e){delete e[b];c.isEmptyObject(e)&&c.removeData(a)}}else{if(c.support.deleteExpando)delete a[c.expando];
else a.removeAttribute&&a.removeAttribute(c.expando);delete f[d]}}}});c.fn.extend({data:function(a,b){if(typeof a==="undefined"&&this.length)return c.data(this[0]);else if(typeof a==="object")return this.each(function(){c.data(this,a)});var d=a.split(".");d[1]=d[1]?"."+d[1]:"";if(b===w){var f=this.triggerHandler("getData"+d[1]+"!",[d[0]]);if(f===w&&this.length)f=c.data(this[0],a);return f===w&&d[1]?this.data(d[0]):f}else return this.trigger("setData"+d[1]+"!",[d[0],b]).each(function(){c.data(this,
a,b)})},removeData:function(a){return this.each(function(){c.removeData(this,a)})}});c.extend({queue:function(a,b,d){if(a){b=(b||"fx")+"queue";var f=c.data(a,b);if(!d)return f||[];if(!f||c.isArray(d))f=c.data(a,b,c.makeArray(d));else f.push(d);return f}},dequeue:function(a,b){b=b||"fx";var d=c.queue(a,b),f=d.shift();if(f==="inprogress")f=d.shift();if(f){b==="fx"&&d.unshift("inprogress");f.call(a,function(){c.dequeue(a,b)})}}});c.fn.extend({queue:function(a,b){if(typeof a!=="string"){b=a;a="fx"}if(b===
w)return c.queue(this[0],a);return this.each(function(){var d=c.queue(this,a,b);a==="fx"&&d[0]!=="inprogress"&&c.dequeue(this,a)})},dequeue:function(a){return this.each(function(){c.dequeue(this,a)})},delay:function(a,b){a=c.fx?c.fx.speeds[a]||a:a;b=b||"fx";return this.queue(b,function(){var d=this;setTimeout(function(){c.dequeue(d,b)},a)})},clearQueue:function(a){return this.queue(a||"fx",[])}});var Aa=/[\n\t]/g,ca=/\s+/,Za=/\r/g,$a=/href|src|style/,ab=/(button|input)/i,bb=/(button|input|object|select|textarea)/i,
cb=/^(a|area)$/i,Ba=/radio|checkbox/;c.fn.extend({attr:function(a,b){return X(this,a,b,true,c.attr)},removeAttr:function(a){return this.each(function(){c.attr(this,a,"");this.nodeType===1&&this.removeAttribute(a)})},addClass:function(a){if(c.isFunction(a))return this.each(function(n){var r=c(this);r.addClass(a.call(this,n,r.attr("class")))});if(a&&typeof a==="string")for(var b=(a||"").split(ca),d=0,f=this.length;d<f;d++){var e=this[d];if(e.nodeType===1)if(e.className){for(var j=" "+e.className+" ",
i=e.className,o=0,k=b.length;o<k;o++)if(j.indexOf(" "+b[o]+" ")<0)i+=" "+b[o];e.className=c.trim(i)}else e.className=a}return this},removeClass:function(a){if(c.isFunction(a))return this.each(function(k){var n=c(this);n.removeClass(a.call(this,k,n.attr("class")))});if(a&&typeof a==="string"||a===w)for(var b=(a||"").split(ca),d=0,f=this.length;d<f;d++){var e=this[d];if(e.nodeType===1&&e.className)if(a){for(var j=(" "+e.className+" ").replace(Aa," "),i=0,o=b.length;i<o;i++)j=j.replace(" "+b[i]+" ",
" ");e.className=c.trim(j)}else e.className=""}return this},toggleClass:function(a,b){var d=typeof a,f=typeof b==="boolean";if(c.isFunction(a))return this.each(function(e){var j=c(this);j.toggleClass(a.call(this,e,j.attr("class"),b),b)});return this.each(function(){if(d==="string")for(var e,j=0,i=c(this),o=b,k=a.split(ca);e=k[j++];){o=f?o:!i.hasClass(e);i[o?"addClass":"removeClass"](e)}else if(d==="undefined"||d==="boolean"){this.className&&c.data(this,"__className__",this.className);this.className=
this.className||a===false?"":c.data(this,"__className__")||""}})},hasClass:function(a){a=" "+a+" ";for(var b=0,d=this.length;b<d;b++)if((" "+this[b].className+" ").replace(Aa," ").indexOf(a)>-1)return true;return false},val:function(a){if(a===w){var b=this[0];if(b){if(c.nodeName(b,"option"))return(b.attributes.value||{}).specified?b.value:b.text;if(c.nodeName(b,"select")){var d=b.selectedIndex,f=[],e=b.options;b=b.type==="select-one";if(d<0)return null;var j=b?d:0;for(d=b?d+1:e.length;j<d;j++){var i=
e[j];if(i.selected){a=c(i).val();if(b)return a;f.push(a)}}return f}if(Ba.test(b.type)&&!c.support.checkOn)return b.getAttribute("value")===null?"on":b.value;return(b.value||"").replace(Za,"")}return w}var o=c.isFunction(a);return this.each(function(k){var n=c(this),r=a;if(this.nodeType===1){if(o)r=a.call(this,k,n.val());if(typeof r==="number")r+="";if(c.isArray(r)&&Ba.test(this.type))this.checked=c.inArray(n.val(),r)>=0;else if(c.nodeName(this,"select")){var u=c.makeArray(r);c("option",this).each(function(){this.selected=
c.inArray(c(this).val(),u)>=0});if(!u.length)this.selectedIndex=-1}else this.value=r}})}});c.extend({attrFn:{val:true,css:true,html:true,text:true,data:true,width:true,height:true,offset:true},attr:function(a,b,d,f){if(!a||a.nodeType===3||a.nodeType===8)return w;if(f&&b in c.attrFn)return c(a)[b](d);f=a.nodeType!==1||!c.isXMLDoc(a);var e=d!==w;b=f&&c.props[b]||b;if(a.nodeType===1){var j=$a.test(b);if(b in a&&f&&!j){if(e){b==="type"&&ab.test(a.nodeName)&&a.parentNode&&c.error("type property can't be changed");
a[b]=d}if(c.nodeName(a,"form")&&a.getAttributeNode(b))return a.getAttributeNode(b).nodeValue;if(b==="tabIndex")return(b=a.getAttributeNode("tabIndex"))&&b.specified?b.value:bb.test(a.nodeName)||cb.test(a.nodeName)&&a.href?0:w;return a[b]}if(!c.support.style&&f&&b==="style"){if(e)a.style.cssText=""+d;return a.style.cssText}e&&a.setAttribute(b,""+d);a=!c.support.hrefNormalized&&f&&j?a.getAttribute(b,2):a.getAttribute(b);return a===null?w:a}return c.style(a,b,d)}});var O=/\.(.*)$/,db=function(a){return a.replace(/[^\w\s\.\|`]/g,
function(b){return"\\"+b})};c.event={add:function(a,b,d,f){if(!(a.nodeType===3||a.nodeType===8)){if(a.setInterval&&a!==A&&!a.frameElement)a=A;var e,j;if(d.handler){e=d;d=e.handler}if(!d.guid)d.guid=c.guid++;if(j=c.data(a)){var i=j.events=j.events||{},o=j.handle;if(!o)j.handle=o=function(){return typeof c!=="undefined"&&!c.event.triggered?c.event.handle.apply(o.elem,arguments):w};o.elem=a;b=b.split(" ");for(var k,n=0,r;k=b[n++];){j=e?c.extend({},e):{handler:d,data:f};if(k.indexOf(".")>-1){r=k.split(".");
k=r.shift();j.namespace=r.slice(0).sort().join(".")}else{r=[];j.namespace=""}j.type=k;j.guid=d.guid;var u=i[k],z=c.event.special[k]||{};if(!u){u=i[k]=[];if(!z.setup||z.setup.call(a,f,r,o)===false)if(a.addEventListener)a.addEventListener(k,o,false);else a.attachEvent&&a.attachEvent("on"+k,o)}if(z.add){z.add.call(a,j);if(!j.handler.guid)j.handler.guid=d.guid}u.push(j);c.event.global[k]=true}a=null}}},global:{},remove:function(a,b,d,f){if(!(a.nodeType===3||a.nodeType===8)){var e,j=0,i,o,k,n,r,u,z=c.data(a),
C=z&&z.events;if(z&&C){if(b&&b.type){d=b.handler;b=b.type}if(!b||typeof b==="string"&&b.charAt(0)==="."){b=b||"";for(e in C)c.event.remove(a,e+b)}else{for(b=b.split(" ");e=b[j++];){n=e;i=e.indexOf(".")<0;o=[];if(!i){o=e.split(".");e=o.shift();k=new RegExp("(^|\\.)"+c.map(o.slice(0).sort(),db).join("\\.(?:.*\\.)?")+"(\\.|$)")}if(r=C[e])if(d){n=c.event.special[e]||{};for(B=f||0;B<r.length;B++){u=r[B];if(d.guid===u.guid){if(i||k.test(u.namespace)){f==null&&r.splice(B--,1);n.remove&&n.remove.call(a,u)}if(f!=
null)break}}if(r.length===0||f!=null&&r.length===1){if(!n.teardown||n.teardown.call(a,o)===false)Ca(a,e,z.handle);delete C[e]}}else for(var B=0;B<r.length;B++){u=r[B];if(i||k.test(u.namespace)){c.event.remove(a,n,u.handler,B);r.splice(B--,1)}}}if(c.isEmptyObject(C)){if(b=z.handle)b.elem=null;delete z.events;delete z.handle;c.isEmptyObject(z)&&c.removeData(a)}}}}},trigger:function(a,b,d,f){var e=a.type||a;if(!f){a=typeof a==="object"?a[G]?a:c.extend(c.Event(e),a):c.Event(e);if(e.indexOf("!")>=0){a.type=
e=e.slice(0,-1);a.exclusive=true}if(!d){a.stopPropagation();c.event.global[e]&&c.each(c.cache,function(){this.events&&this.events[e]&&c.event.trigger(a,b,this.handle.elem)})}if(!d||d.nodeType===3||d.nodeType===8)return w;a.result=w;a.target=d;b=c.makeArray(b);b.unshift(a)}a.currentTarget=d;(f=c.data(d,"handle"))&&f.apply(d,b);f=d.parentNode||d.ownerDocument;try{if(!(d&&d.nodeName&&c.noData[d.nodeName.toLowerCase()]))if(d["on"+e]&&d["on"+e].apply(d,b)===false)a.result=false}catch(j){}if(!a.isPropagationStopped()&&
f)c.event.trigger(a,b,f,true);else if(!a.isDefaultPrevented()){f=a.target;var i,o=c.nodeName(f,"a")&&e==="click",k=c.event.special[e]||{};if((!k._default||k._default.call(d,a)===false)&&!o&&!(f&&f.nodeName&&c.noData[f.nodeName.toLowerCase()])){try{if(f[e]){if(i=f["on"+e])f["on"+e]=null;c.event.triggered=true;f[e]()}}catch(n){}if(i)f["on"+e]=i;c.event.triggered=false}}},handle:function(a){var b,d,f,e;a=arguments[0]=c.event.fix(a||A.event);a.currentTarget=this;b=a.type.indexOf(".")<0&&!a.exclusive;
if(!b){d=a.type.split(".");a.type=d.shift();f=new RegExp("(^|\\.)"+d.slice(0).sort().join("\\.(?:.*\\.)?")+"(\\.|$)")}e=c.data(this,"events");d=e[a.type];if(e&&d){d=d.slice(0);e=0;for(var j=d.length;e<j;e++){var i=d[e];if(b||f.test(i.namespace)){a.handler=i.handler;a.data=i.data;a.handleObj=i;i=i.handler.apply(this,arguments);if(i!==w){a.result=i;if(i===false){a.preventDefault();a.stopPropagation()}}if(a.isImmediatePropagationStopped())break}}}return a.result},props:"altKey attrChange attrName bubbles button cancelable charCode clientX clientY ctrlKey currentTarget data detail eventPhase fromElement handler keyCode layerX layerY metaKey newValue offsetX offsetY originalTarget pageX pageY prevValue relatedNode relatedTarget screenX screenY shiftKey srcElement target toElement view wheelDelta which".split(" "),
fix:function(a){if(a[G])return a;var b=a;a=c.Event(b);for(var d=this.props.length,f;d;){f=this.props[--d];a[f]=b[f]}if(!a.target)a.target=a.srcElement||s;if(a.target.nodeType===3)a.target=a.target.parentNode;if(!a.relatedTarget&&a.fromElement)a.relatedTarget=a.fromElement===a.target?a.toElement:a.fromElement;if(a.pageX==null&&a.clientX!=null){b=s.documentElement;d=s.body;a.pageX=a.clientX+(b&&b.scrollLeft||d&&d.scrollLeft||0)-(b&&b.clientLeft||d&&d.clientLeft||0);a.pageY=a.clientY+(b&&b.scrollTop||
d&&d.scrollTop||0)-(b&&b.clientTop||d&&d.clientTop||0)}if(!a.which&&(a.charCode||a.charCode===0?a.charCode:a.keyCode))a.which=a.charCode||a.keyCode;if(!a.metaKey&&a.ctrlKey)a.metaKey=a.ctrlKey;if(!a.which&&a.button!==w)a.which=a.button&1?1:a.button&2?3:a.button&4?2:0;return a},guid:1E8,proxy:c.proxy,special:{ready:{setup:c.bindReady,teardown:c.noop},live:{add:function(a){c.event.add(this,a.origType,c.extend({},a,{handler:oa}))},remove:function(a){var b=true,d=a.origType.replace(O,"");c.each(c.data(this,
"events").live||[],function(){if(d===this.origType.replace(O,""))return b=false});b&&c.event.remove(this,a.origType,oa)}},beforeunload:{setup:function(a,b,d){if(this.setInterval)this.onbeforeunload=d;return false},teardown:function(a,b){if(this.onbeforeunload===b)this.onbeforeunload=null}}}};var Ca=s.removeEventListener?function(a,b,d){a.removeEventListener(b,d,false)}:function(a,b,d){a.detachEvent("on"+b,d)};c.Event=function(a){if(!this.preventDefault)return new c.Event(a);if(a&&a.type){this.originalEvent=
a;this.type=a.type}else this.type=a;this.timeStamp=J();this[G]=true};c.Event.prototype={preventDefault:function(){this.isDefaultPrevented=Z;var a=this.originalEvent;if(a){a.preventDefault&&a.preventDefault();a.returnValue=false}},stopPropagation:function(){this.isPropagationStopped=Z;var a=this.originalEvent;if(a){a.stopPropagation&&a.stopPropagation();a.cancelBubble=true}},stopImmediatePropagation:function(){this.isImmediatePropagationStopped=Z;this.stopPropagation()},isDefaultPrevented:Y,isPropagationStopped:Y,
isImmediatePropagationStopped:Y};var Da=function(a){var b=a.relatedTarget;try{for(;b&&b!==this;)b=b.parentNode;if(b!==this){a.type=a.data;c.event.handle.apply(this,arguments)}}catch(d){}},Ea=function(a){a.type=a.data;c.event.handle.apply(this,arguments)};c.each({mouseenter:"mouseover",mouseleave:"mouseout"},function(a,b){c.event.special[a]={setup:function(d){c.event.add(this,b,d&&d.selector?Ea:Da,a)},teardown:function(d){c.event.remove(this,b,d&&d.selector?Ea:Da)}}});if(!c.support.submitBubbles)c.event.special.submit=
{setup:function(){if(this.nodeName.toLowerCase()!=="form"){c.event.add(this,"click.specialSubmit",function(a){var b=a.target,d=b.type;if((d==="submit"||d==="image")&&c(b).closest("form").length)return na("submit",this,arguments)});c.event.add(this,"keypress.specialSubmit",function(a){var b=a.target,d=b.type;if((d==="text"||d==="password")&&c(b).closest("form").length&&a.keyCode===13)return na("submit",this,arguments)})}else return false},teardown:function(){c.event.remove(this,".specialSubmit")}};
if(!c.support.changeBubbles){var da=/textarea|input|select/i,ea,Fa=function(a){var b=a.type,d=a.value;if(b==="radio"||b==="checkbox")d=a.checked;else if(b==="select-multiple")d=a.selectedIndex>-1?c.map(a.options,function(f){return f.selected}).join("-"):"";else if(a.nodeName.toLowerCase()==="select")d=a.selectedIndex;return d},fa=function(a,b){var d=a.target,f,e;if(!(!da.test(d.nodeName)||d.readOnly)){f=c.data(d,"_change_data");e=Fa(d);if(a.type!=="focusout"||d.type!=="radio")c.data(d,"_change_data",
e);if(!(f===w||e===f))if(f!=null||e){a.type="change";return c.event.trigger(a,b,d)}}};c.event.special.change={filters:{focusout:fa,click:function(a){var b=a.target,d=b.type;if(d==="radio"||d==="checkbox"||b.nodeName.toLowerCase()==="select")return fa.call(this,a)},keydown:function(a){var b=a.target,d=b.type;if(a.keyCode===13&&b.nodeName.toLowerCase()!=="textarea"||a.keyCode===32&&(d==="checkbox"||d==="radio")||d==="select-multiple")return fa.call(this,a)},beforeactivate:function(a){a=a.target;c.data(a,
"_change_data",Fa(a))}},setup:function(){if(this.type==="file")return false;for(var a in ea)c.event.add(this,a+".specialChange",ea[a]);return da.test(this.nodeName)},teardown:function(){c.event.remove(this,".specialChange");return da.test(this.nodeName)}};ea=c.event.special.change.filters}s.addEventListener&&c.each({focus:"focusin",blur:"focusout"},function(a,b){function d(f){f=c.event.fix(f);f.type=b;return c.event.handle.call(this,f)}c.event.special[b]={setup:function(){this.addEventListener(a,
d,true)},teardown:function(){this.removeEventListener(a,d,true)}}});c.each(["bind","one"],function(a,b){c.fn[b]=function(d,f,e){if(typeof d==="object"){for(var j in d)this[b](j,f,d[j],e);return this}if(c.isFunction(f)){e=f;f=w}var i=b==="one"?c.proxy(e,function(k){c(this).unbind(k,i);return e.apply(this,arguments)}):e;if(d==="unload"&&b!=="one")this.one(d,f,e);else{j=0;for(var o=this.length;j<o;j++)c.event.add(this[j],d,i,f)}return this}});c.fn.extend({unbind:function(a,b){if(typeof a==="object"&&
!a.preventDefault)for(var d in a)this.unbind(d,a[d]);else{d=0;for(var f=this.length;d<f;d++)c.event.remove(this[d],a,b)}return this},delegate:function(a,b,d,f){return this.live(b,d,f,a)},undelegate:function(a,b,d){return arguments.length===0?this.unbind("live"):this.die(b,null,d,a)},trigger:function(a,b){return this.each(function(){c.event.trigger(a,b,this)})},triggerHandler:function(a,b){if(this[0]){a=c.Event(a);a.preventDefault();a.stopPropagation();c.event.trigger(a,b,this[0]);return a.result}},
toggle:function(a){for(var b=arguments,d=1;d<b.length;)c.proxy(a,b[d++]);return this.click(c.proxy(a,function(f){var e=(c.data(this,"lastToggle"+a.guid)||0)%d;c.data(this,"lastToggle"+a.guid,e+1);f.preventDefault();return b[e].apply(this,arguments)||false}))},hover:function(a,b){return this.mouseenter(a).mouseleave(b||a)}});var Ga={focus:"focusin",blur:"focusout",mouseenter:"mouseover",mouseleave:"mouseout"};c.each(["live","die"],function(a,b){c.fn[b]=function(d,f,e,j){var i,o=0,k,n,r=j||this.selector,
u=j?this:c(this.context);if(c.isFunction(f)){e=f;f=w}for(d=(d||"").split(" ");(i=d[o++])!=null;){j=O.exec(i);k="";if(j){k=j[0];i=i.replace(O,"")}if(i==="hover")d.push("mouseenter"+k,"mouseleave"+k);else{n=i;if(i==="focus"||i==="blur"){d.push(Ga[i]+k);i+=k}else i=(Ga[i]||i)+k;b==="live"?u.each(function(){c.event.add(this,pa(i,r),{data:f,selector:r,handler:e,origType:i,origHandler:e,preType:n})}):u.unbind(pa(i,r),e)}}return this}});c.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error".split(" "),
function(a,b){c.fn[b]=function(d){return d?this.bind(b,d):this.trigger(b)};if(c.attrFn)c.attrFn[b]=true});A.attachEvent&&!A.addEventListener&&A.attachEvent("onunload",function(){for(var a in c.cache)if(c.cache[a].handle)try{c.event.remove(c.cache[a].handle.elem)}catch(b){}});(function(){function a(g){for(var h="",l,m=0;g[m];m++){l=g[m];if(l.nodeType===3||l.nodeType===4)h+=l.nodeValue;else if(l.nodeType!==8)h+=a(l.childNodes)}return h}function b(g,h,l,m,q,p){q=0;for(var v=m.length;q<v;q++){var t=m[q];
if(t){t=t[g];for(var y=false;t;){if(t.sizcache===l){y=m[t.sizset];break}if(t.nodeType===1&&!p){t.sizcache=l;t.sizset=q}if(t.nodeName.toLowerCase()===h){y=t;break}t=t[g]}m[q]=y}}}function d(g,h,l,m,q,p){q=0;for(var v=m.length;q<v;q++){var t=m[q];if(t){t=t[g];for(var y=false;t;){if(t.sizcache===l){y=m[t.sizset];break}if(t.nodeType===1){if(!p){t.sizcache=l;t.sizset=q}if(typeof h!=="string"){if(t===h){y=true;break}}else if(k.filter(h,[t]).length>0){y=t;break}}t=t[g]}m[q]=y}}}var f=/((?:\((?:\([^()]+\)|[^()]+)+\)|\[(?:\[[^[\]]*\]|['"][^'"]*['"]|[^[\]'"]+)+\]|\\.|[^ >+~,(\[\\]+)+|[>+~])(\s*,\s*)?((?:.|\r|\n)*)/g,
e=0,j=Object.prototype.toString,i=false,o=true;[0,0].sort(function(){o=false;return 0});var k=function(g,h,l,m){l=l||[];var q=h=h||s;if(h.nodeType!==1&&h.nodeType!==9)return[];if(!g||typeof g!=="string")return l;for(var p=[],v,t,y,S,H=true,M=x(h),I=g;(f.exec(""),v=f.exec(I))!==null;){I=v[3];p.push(v[1]);if(v[2]){S=v[3];break}}if(p.length>1&&r.exec(g))if(p.length===2&&n.relative[p[0]])t=ga(p[0]+p[1],h);else for(t=n.relative[p[0]]?[h]:k(p.shift(),h);p.length;){g=p.shift();if(n.relative[g])g+=p.shift();
t=ga(g,t)}else{if(!m&&p.length>1&&h.nodeType===9&&!M&&n.match.ID.test(p[0])&&!n.match.ID.test(p[p.length-1])){v=k.find(p.shift(),h,M);h=v.expr?k.filter(v.expr,v.set)[0]:v.set[0]}if(h){v=m?{expr:p.pop(),set:z(m)}:k.find(p.pop(),p.length===1&&(p[0]==="~"||p[0]==="+")&&h.parentNode?h.parentNode:h,M);t=v.expr?k.filter(v.expr,v.set):v.set;if(p.length>0)y=z(t);else H=false;for(;p.length;){var D=p.pop();v=D;if(n.relative[D])v=p.pop();else D="";if(v==null)v=h;n.relative[D](y,v,M)}}else y=[]}y||(y=t);y||k.error(D||
g);if(j.call(y)==="[object Array]")if(H)if(h&&h.nodeType===1)for(g=0;y[g]!=null;g++){if(y[g]&&(y[g]===true||y[g].nodeType===1&&E(h,y[g])))l.push(t[g])}else for(g=0;y[g]!=null;g++)y[g]&&y[g].nodeType===1&&l.push(t[g]);else l.push.apply(l,y);else z(y,l);if(S){k(S,q,l,m);k.uniqueSort(l)}return l};k.uniqueSort=function(g){if(B){i=o;g.sort(B);if(i)for(var h=1;h<g.length;h++)g[h]===g[h-1]&&g.splice(h--,1)}return g};k.matches=function(g,h){return k(g,null,null,h)};k.find=function(g,h,l){var m,q;if(!g)return[];
for(var p=0,v=n.order.length;p<v;p++){var t=n.order[p];if(q=n.leftMatch[t].exec(g)){var y=q[1];q.splice(1,1);if(y.substr(y.length-1)!=="\\"){q[1]=(q[1]||"").replace(/\\/g,"");m=n.find[t](q,h,l);if(m!=null){g=g.replace(n.match[t],"");break}}}}m||(m=h.getElementsByTagName("*"));return{set:m,expr:g}};k.filter=function(g,h,l,m){for(var q=g,p=[],v=h,t,y,S=h&&h[0]&&x(h[0]);g&&h.length;){for(var H in n.filter)if((t=n.leftMatch[H].exec(g))!=null&&t[2]){var M=n.filter[H],I,D;D=t[1];y=false;t.splice(1,1);if(D.substr(D.length-
1)!=="\\"){if(v===p)p=[];if(n.preFilter[H])if(t=n.preFilter[H](t,v,l,p,m,S)){if(t===true)continue}else y=I=true;if(t)for(var U=0;(D=v[U])!=null;U++)if(D){I=M(D,t,U,v);var Ha=m^!!I;if(l&&I!=null)if(Ha)y=true;else v[U]=false;else if(Ha){p.push(D);y=true}}if(I!==w){l||(v=p);g=g.replace(n.match[H],"");if(!y)return[];break}}}if(g===q)if(y==null)k.error(g);else break;q=g}return v};k.error=function(g){throw"Syntax error, unrecognized expression: "+g;};var n=k.selectors={order:["ID","NAME","TAG"],match:{ID:/#((?:[\w\u00c0-\uFFFF-]|\\.)+)/,
CLASS:/\.((?:[\w\u00c0-\uFFFF-]|\\.)+)/,NAME:/\[name=['"]*((?:[\w\u00c0-\uFFFF-]|\\.)+)['"]*\]/,ATTR:/\[\s*((?:[\w\u00c0-\uFFFF-]|\\.)+)\s*(?:(\S?=)\s*(['"]*)(.*?)\3|)\s*\]/,TAG:/^((?:[\w\u00c0-\uFFFF\*-]|\\.)+)/,CHILD:/:(only|nth|last|first)-child(?:\((even|odd|[\dn+-]*)\))?/,POS:/:(nth|eq|gt|lt|first|last|even|odd)(?:\((\d*)\))?(?=[^-]|$)/,PSEUDO:/:((?:[\w\u00c0-\uFFFF-]|\\.)+)(?:\((['"]?)((?:\([^\)]+\)|[^\(\)]*)+)\2\))?/},leftMatch:{},attrMap:{"class":"className","for":"htmlFor"},attrHandle:{href:function(g){return g.getAttribute("href")}},
relative:{"+":function(g,h){var l=typeof h==="string",m=l&&!/\W/.test(h);l=l&&!m;if(m)h=h.toLowerCase();m=0;for(var q=g.length,p;m<q;m++)if(p=g[m]){for(;(p=p.previousSibling)&&p.nodeType!==1;);g[m]=l||p&&p.nodeName.toLowerCase()===h?p||false:p===h}l&&k.filter(h,g,true)},">":function(g,h){var l=typeof h==="string";if(l&&!/\W/.test(h)){h=h.toLowerCase();for(var m=0,q=g.length;m<q;m++){var p=g[m];if(p){l=p.parentNode;g[m]=l.nodeName.toLowerCase()===h?l:false}}}else{m=0;for(q=g.length;m<q;m++)if(p=g[m])g[m]=
l?p.parentNode:p.parentNode===h;l&&k.filter(h,g,true)}},"":function(g,h,l){var m=e++,q=d;if(typeof h==="string"&&!/\W/.test(h)){var p=h=h.toLowerCase();q=b}q("parentNode",h,m,g,p,l)},"~":function(g,h,l){var m=e++,q=d;if(typeof h==="string"&&!/\W/.test(h)){var p=h=h.toLowerCase();q=b}q("previousSibling",h,m,g,p,l)}},find:{ID:function(g,h,l){if(typeof h.getElementById!=="undefined"&&!l)return(g=h.getElementById(g[1]))?[g]:[]},NAME:function(g,h){if(typeof h.getElementsByName!=="undefined"){var l=[];
h=h.getElementsByName(g[1]);for(var m=0,q=h.length;m<q;m++)h[m].getAttribute("name")===g[1]&&l.push(h[m]);return l.length===0?null:l}},TAG:function(g,h){return h.getElementsByTagName(g[1])}},preFilter:{CLASS:function(g,h,l,m,q,p){g=" "+g[1].replace(/\\/g,"")+" ";if(p)return g;p=0;for(var v;(v=h[p])!=null;p++)if(v)if(q^(v.className&&(" "+v.className+" ").replace(/[\t\n]/g," ").indexOf(g)>=0))l||m.push(v);else if(l)h[p]=false;return false},ID:function(g){return g[1].replace(/\\/g,"")},TAG:function(g){return g[1].toLowerCase()},
CHILD:function(g){if(g[1]==="nth"){var h=/(-?)(\d*)n((?:\+|-)?\d*)/.exec(g[2]==="even"&&"2n"||g[2]==="odd"&&"2n+1"||!/\D/.test(g[2])&&"0n+"+g[2]||g[2]);g[2]=h[1]+(h[2]||1)-0;g[3]=h[3]-0}g[0]=e++;return g},ATTR:function(g,h,l,m,q,p){h=g[1].replace(/\\/g,"");if(!p&&n.attrMap[h])g[1]=n.attrMap[h];if(g[2]==="~=")g[4]=" "+g[4]+" ";return g},PSEUDO:function(g,h,l,m,q){if(g[1]==="not")if((f.exec(g[3])||"").length>1||/^\w/.test(g[3]))g[3]=k(g[3],null,null,h);else{g=k.filter(g[3],h,l,true^q);l||m.push.apply(m,
g);return false}else if(n.match.POS.test(g[0])||n.match.CHILD.test(g[0]))return true;return g},POS:function(g){g.unshift(true);return g}},filters:{enabled:function(g){return g.disabled===false&&g.type!=="hidden"},disabled:function(g){return g.disabled===true},checked:function(g){return g.checked===true},selected:function(g){return g.selected===true},parent:function(g){return!!g.firstChild},empty:function(g){return!g.firstChild},has:function(g,h,l){return!!k(l[3],g).length},header:function(g){return/h\d/i.test(g.nodeName)},
text:function(g){return"text"===g.type},radio:function(g){return"radio"===g.type},checkbox:function(g){return"checkbox"===g.type},file:function(g){return"file"===g.type},password:function(g){return"password"===g.type},submit:function(g){return"submit"===g.type},image:function(g){return"image"===g.type},reset:function(g){return"reset"===g.type},button:function(g){return"button"===g.type||g.nodeName.toLowerCase()==="button"},input:function(g){return/input|select|textarea|button/i.test(g.nodeName)}},
setFilters:{first:function(g,h){return h===0},last:function(g,h,l,m){return h===m.length-1},even:function(g,h){return h%2===0},odd:function(g,h){return h%2===1},lt:function(g,h,l){return h<l[3]-0},gt:function(g,h,l){return h>l[3]-0},nth:function(g,h,l){return l[3]-0===h},eq:function(g,h,l){return l[3]-0===h}},filter:{PSEUDO:function(g,h,l,m){var q=h[1],p=n.filters[q];if(p)return p(g,l,h,m);else if(q==="contains")return(g.textContent||g.innerText||a([g])||"").indexOf(h[3])>=0;else if(q==="not"){h=
h[3];l=0;for(m=h.length;l<m;l++)if(h[l]===g)return false;return true}else k.error("Syntax error, unrecognized expression: "+q)},CHILD:function(g,h){var l=h[1],m=g;switch(l){case "only":case "first":for(;m=m.previousSibling;)if(m.nodeType===1)return false;if(l==="first")return true;m=g;case "last":for(;m=m.nextSibling;)if(m.nodeType===1)return false;return true;case "nth":l=h[2];var q=h[3];if(l===1&&q===0)return true;h=h[0];var p=g.parentNode;if(p&&(p.sizcache!==h||!g.nodeIndex)){var v=0;for(m=p.firstChild;m;m=
m.nextSibling)if(m.nodeType===1)m.nodeIndex=++v;p.sizcache=h}g=g.nodeIndex-q;return l===0?g===0:g%l===0&&g/l>=0}},ID:function(g,h){return g.nodeType===1&&g.getAttribute("id")===h},TAG:function(g,h){return h==="*"&&g.nodeType===1||g.nodeName.toLowerCase()===h},CLASS:function(g,h){return(" "+(g.className||g.getAttribute("class"))+" ").indexOf(h)>-1},ATTR:function(g,h){var l=h[1];g=n.attrHandle[l]?n.attrHandle[l](g):g[l]!=null?g[l]:g.getAttribute(l);l=g+"";var m=h[2];h=h[4];return g==null?m==="!=":m===
"="?l===h:m==="*="?l.indexOf(h)>=0:m==="~="?(" "+l+" ").indexOf(h)>=0:!h?l&&g!==false:m==="!="?l!==h:m==="^="?l.indexOf(h)===0:m==="$="?l.substr(l.length-h.length)===h:m==="|="?l===h||l.substr(0,h.length+1)===h+"-":false},POS:function(g,h,l,m){var q=n.setFilters[h[2]];if(q)return q(g,l,h,m)}}},r=n.match.POS;for(var u in n.match){n.match[u]=new RegExp(n.match[u].source+/(?![^\[]*\])(?![^\(]*\))/.source);n.leftMatch[u]=new RegExp(/(^(?:.|\r|\n)*?)/.source+n.match[u].source.replace(/\\(\d+)/g,function(g,
h){return"\\"+(h-0+1)}))}var z=function(g,h){g=Array.prototype.slice.call(g,0);if(h){h.push.apply(h,g);return h}return g};try{Array.prototype.slice.call(s.documentElement.childNodes,0)}catch(C){z=function(g,h){h=h||[];if(j.call(g)==="[object Array]")Array.prototype.push.apply(h,g);else if(typeof g.length==="number")for(var l=0,m=g.length;l<m;l++)h.push(g[l]);else for(l=0;g[l];l++)h.push(g[l]);return h}}var B;if(s.documentElement.compareDocumentPosition)B=function(g,h){if(!g.compareDocumentPosition||
!h.compareDocumentPosition){if(g==h)i=true;return g.compareDocumentPosition?-1:1}g=g.compareDocumentPosition(h)&4?-1:g===h?0:1;if(g===0)i=true;return g};else if("sourceIndex"in s.documentElement)B=function(g,h){if(!g.sourceIndex||!h.sourceIndex){if(g==h)i=true;return g.sourceIndex?-1:1}g=g.sourceIndex-h.sourceIndex;if(g===0)i=true;return g};else if(s.createRange)B=function(g,h){if(!g.ownerDocument||!h.ownerDocument){if(g==h)i=true;return g.ownerDocument?-1:1}var l=g.ownerDocument.createRange(),m=
h.ownerDocument.createRange();l.setStart(g,0);l.setEnd(g,0);m.setStart(h,0);m.setEnd(h,0);g=l.compareBoundaryPoints(Range.START_TO_END,m);if(g===0)i=true;return g};(function(){var g=s.createElement("div"),h="script"+(new Date).getTime();g.innerHTML="<a name='"+h+"'/>";var l=s.documentElement;l.insertBefore(g,l.firstChild);if(s.getElementById(h)){n.find.ID=function(m,q,p){if(typeof q.getElementById!=="undefined"&&!p)return(q=q.getElementById(m[1]))?q.id===m[1]||typeof q.getAttributeNode!=="undefined"&&
q.getAttributeNode("id").nodeValue===m[1]?[q]:w:[]};n.filter.ID=function(m,q){var p=typeof m.getAttributeNode!=="undefined"&&m.getAttributeNode("id");return m.nodeType===1&&p&&p.nodeValue===q}}l.removeChild(g);l=g=null})();(function(){var g=s.createElement("div");g.appendChild(s.createComment(""));if(g.getElementsByTagName("*").length>0)n.find.TAG=function(h,l){l=l.getElementsByTagName(h[1]);if(h[1]==="*"){h=[];for(var m=0;l[m];m++)l[m].nodeType===1&&h.push(l[m]);l=h}return l};g.innerHTML="<a href='#'></a>";
if(g.firstChild&&typeof g.firstChild.getAttribute!=="undefined"&&g.firstChild.getAttribute("href")!=="#")n.attrHandle.href=function(h){return h.getAttribute("href",2)};g=null})();s.querySelectorAll&&function(){var g=k,h=s.createElement("div");h.innerHTML="<p class='TEST'></p>";if(!(h.querySelectorAll&&h.querySelectorAll(".TEST").length===0)){k=function(m,q,p,v){q=q||s;if(!v&&q.nodeType===9&&!x(q))try{return z(q.querySelectorAll(m),p)}catch(t){}return g(m,q,p,v)};for(var l in g)k[l]=g[l];h=null}}();
(function(){var g=s.createElement("div");g.innerHTML="<div class='test e'></div><div class='test'></div>";if(!(!g.getElementsByClassName||g.getElementsByClassName("e").length===0)){g.lastChild.className="e";if(g.getElementsByClassName("e").length!==1){n.order.splice(1,0,"CLASS");n.find.CLASS=function(h,l,m){if(typeof l.getElementsByClassName!=="undefined"&&!m)return l.getElementsByClassName(h[1])};g=null}}})();var E=s.compareDocumentPosition?function(g,h){return!!(g.compareDocumentPosition(h)&16)}:
function(g,h){return g!==h&&(g.contains?g.contains(h):true)},x=function(g){return(g=(g?g.ownerDocument||g:0).documentElement)?g.nodeName!=="HTML":false},ga=function(g,h){var l=[],m="",q;for(h=h.nodeType?[h]:h;q=n.match.PSEUDO.exec(g);){m+=q[0];g=g.replace(n.match.PSEUDO,"")}g=n.relative[g]?g+"*":g;q=0;for(var p=h.length;q<p;q++)k(g,h[q],l);return k.filter(m,l)};c.find=k;c.expr=k.selectors;c.expr[":"]=c.expr.filters;c.unique=k.uniqueSort;c.text=a;c.isXMLDoc=x;c.contains=E})();var eb=/Until$/,fb=/^(?:parents|prevUntil|prevAll)/,
gb=/,/;R=Array.prototype.slice;var Ia=function(a,b,d){if(c.isFunction(b))return c.grep(a,function(e,j){return!!b.call(e,j,e)===d});else if(b.nodeType)return c.grep(a,function(e){return e===b===d});else if(typeof b==="string"){var f=c.grep(a,function(e){return e.nodeType===1});if(Ua.test(b))return c.filter(b,f,!d);else b=c.filter(b,f)}return c.grep(a,function(e){return c.inArray(e,b)>=0===d})};c.fn.extend({find:function(a){for(var b=this.pushStack("","find",a),d=0,f=0,e=this.length;f<e;f++){d=b.length;
c.find(a,this[f],b);if(f>0)for(var j=d;j<b.length;j++)for(var i=0;i<d;i++)if(b[i]===b[j]){b.splice(j--,1);break}}return b},has:function(a){var b=c(a);return this.filter(function(){for(var d=0,f=b.length;d<f;d++)if(c.contains(this,b[d]))return true})},not:function(a){return this.pushStack(Ia(this,a,false),"not",a)},filter:function(a){return this.pushStack(Ia(this,a,true),"filter",a)},is:function(a){return!!a&&c.filter(a,this).length>0},closest:function(a,b){if(c.isArray(a)){var d=[],f=this[0],e,j=
{},i;if(f&&a.length){e=0;for(var o=a.length;e<o;e++){i=a[e];j[i]||(j[i]=c.expr.match.POS.test(i)?c(i,b||this.context):i)}for(;f&&f.ownerDocument&&f!==b;){for(i in j){e=j[i];if(e.jquery?e.index(f)>-1:c(f).is(e)){d.push({selector:i,elem:f});delete j[i]}}f=f.parentNode}}return d}var k=c.expr.match.POS.test(a)?c(a,b||this.context):null;return this.map(function(n,r){for(;r&&r.ownerDocument&&r!==b;){if(k?k.index(r)>-1:c(r).is(a))return r;r=r.parentNode}return null})},index:function(a){if(!a||typeof a===
"string")return c.inArray(this[0],a?c(a):this.parent().children());return c.inArray(a.jquery?a[0]:a,this)},add:function(a,b){a=typeof a==="string"?c(a,b||this.context):c.makeArray(a);b=c.merge(this.get(),a);return this.pushStack(qa(a[0])||qa(b[0])?b:c.unique(b))},andSelf:function(){return this.add(this.prevObject)}});c.each({parent:function(a){return(a=a.parentNode)&&a.nodeType!==11?a:null},parents:function(a){return c.dir(a,"parentNode")},parentsUntil:function(a,b,d){return c.dir(a,"parentNode",
d)},next:function(a){return c.nth(a,2,"nextSibling")},prev:function(a){return c.nth(a,2,"previousSibling")},nextAll:function(a){return c.dir(a,"nextSibling")},prevAll:function(a){return c.dir(a,"previousSibling")},nextUntil:function(a,b,d){return c.dir(a,"nextSibling",d)},prevUntil:function(a,b,d){return c.dir(a,"previousSibling",d)},siblings:function(a){return c.sibling(a.parentNode.firstChild,a)},children:function(a){return c.sibling(a.firstChild)},contents:function(a){return c.nodeName(a,"iframe")?
a.contentDocument||a.contentWindow.document:c.makeArray(a.childNodes)}},function(a,b){c.fn[a]=function(d,f){var e=c.map(this,b,d);eb.test(a)||(f=d);if(f&&typeof f==="string")e=c.filter(f,e);e=this.length>1?c.unique(e):e;if((this.length>1||gb.test(f))&&fb.test(a))e=e.reverse();return this.pushStack(e,a,R.call(arguments).join(","))}});c.extend({filter:function(a,b,d){if(d)a=":not("+a+")";return c.find.matches(a,b)},dir:function(a,b,d){var f=[];for(a=a[b];a&&a.nodeType!==9&&(d===w||a.nodeType!==1||!c(a).is(d));){a.nodeType===
1&&f.push(a);a=a[b]}return f},nth:function(a,b,d){b=b||1;for(var f=0;a;a=a[d])if(a.nodeType===1&&++f===b)break;return a},sibling:function(a,b){for(var d=[];a;a=a.nextSibling)a.nodeType===1&&a!==b&&d.push(a);return d}});var Ja=/ jQuery\d+="(?:\d+|null)"/g,V=/^\s+/,Ka=/(<([\w:]+)[^>]*?)\/>/g,hb=/^(?:area|br|col|embed|hr|img|input|link|meta|param)$/i,La=/<([\w:]+)/,ib=/<tbody/i,jb=/<|&#?\w+;/,ta=/<script|<object|<embed|<option|<style/i,ua=/checked\s*(?:[^=]|=\s*.checked.)/i,Ma=function(a,b,d){return hb.test(d)?
a:b+"></"+d+">"},F={option:[1,"<select multiple='multiple'>","</select>"],legend:[1,"<fieldset>","</fieldset>"],thead:[1,"<table>","</table>"],tr:[2,"<table><tbody>","</tbody></table>"],td:[3,"<table><tbody><tr>","</tr></tbody></table>"],col:[2,"<table><tbody></tbody><colgroup>","</colgroup></table>"],area:[1,"<map>","</map>"],_default:[0,"",""]};F.optgroup=F.option;F.tbody=F.tfoot=F.colgroup=F.caption=F.thead;F.th=F.td;if(!c.support.htmlSerialize)F._default=[1,"div<div>","</div>"];c.fn.extend({text:function(a){if(c.isFunction(a))return this.each(function(b){var d=
c(this);d.text(a.call(this,b,d.text()))});if(typeof a!=="object"&&a!==w)return this.empty().append((this[0]&&this[0].ownerDocument||s).createTextNode(a));return c.text(this)},wrapAll:function(a){if(c.isFunction(a))return this.each(function(d){c(this).wrapAll(a.call(this,d))});if(this[0]){var b=c(a,this[0].ownerDocument).eq(0).clone(true);this[0].parentNode&&b.insertBefore(this[0]);b.map(function(){for(var d=this;d.firstChild&&d.firstChild.nodeType===1;)d=d.firstChild;return d}).append(this)}return this},
wrapInner:function(a){if(c.isFunction(a))return this.each(function(b){c(this).wrapInner(a.call(this,b))});return this.each(function(){var b=c(this),d=b.contents();d.length?d.wrapAll(a):b.append(a)})},wrap:function(a){return this.each(function(){c(this).wrapAll(a)})},unwrap:function(){return this.parent().each(function(){c.nodeName(this,"body")||c(this).replaceWith(this.childNodes)}).end()},append:function(){return this.domManip(arguments,true,function(a){this.nodeType===1&&this.appendChild(a)})},
prepend:function(){return this.domManip(arguments,true,function(a){this.nodeType===1&&this.insertBefore(a,this.firstChild)})},before:function(){if(this[0]&&this[0].parentNode)return this.domManip(arguments,false,function(b){this.parentNode.insertBefore(b,this)});else if(arguments.length){var a=c(arguments[0]);a.push.apply(a,this.toArray());return this.pushStack(a,"before",arguments)}},after:function(){if(this[0]&&this[0].parentNode)return this.domManip(arguments,false,function(b){this.parentNode.insertBefore(b,
this.nextSibling)});else if(arguments.length){var a=this.pushStack(this,"after",arguments);a.push.apply(a,c(arguments[0]).toArray());return a}},remove:function(a,b){for(var d=0,f;(f=this[d])!=null;d++)if(!a||c.filter(a,[f]).length){if(!b&&f.nodeType===1){c.cleanData(f.getElementsByTagName("*"));c.cleanData([f])}f.parentNode&&f.parentNode.removeChild(f)}return this},empty:function(){for(var a=0,b;(b=this[a])!=null;a++)for(b.nodeType===1&&c.cleanData(b.getElementsByTagName("*"));b.firstChild;)b.removeChild(b.firstChild);
return this},clone:function(a){var b=this.map(function(){if(!c.support.noCloneEvent&&!c.isXMLDoc(this)){var d=this.outerHTML,f=this.ownerDocument;if(!d){d=f.createElement("div");d.appendChild(this.cloneNode(true));d=d.innerHTML}return c.clean([d.replace(Ja,"").replace(/=([^="'>\s]+\/)>/g,'="$1">').replace(V,"")],f)[0]}else return this.cloneNode(true)});if(a===true){ra(this,b);ra(this.find("*"),b.find("*"))}return b},html:function(a){if(a===w)return this[0]&&this[0].nodeType===1?this[0].innerHTML.replace(Ja,
""):null;else if(typeof a==="string"&&!ta.test(a)&&(c.support.leadingWhitespace||!V.test(a))&&!F[(La.exec(a)||["",""])[1].toLowerCase()]){a=a.replace(Ka,Ma);try{for(var b=0,d=this.length;b<d;b++)if(this[b].nodeType===1){c.cleanData(this[b].getElementsByTagName("*"));this[b].innerHTML=a}}catch(f){this.empty().append(a)}}else c.isFunction(a)?this.each(function(e){var j=c(this),i=j.html();j.empty().append(function(){return a.call(this,e,i)})}):this.empty().append(a);return this},replaceWith:function(a){if(this[0]&&
this[0].parentNode){if(c.isFunction(a))return this.each(function(b){var d=c(this),f=d.html();d.replaceWith(a.call(this,b,f))});if(typeof a!=="string")a=c(a).detach();return this.each(function(){var b=this.nextSibling,d=this.parentNode;c(this).remove();b?c(b).before(a):c(d).append(a)})}else return this.pushStack(c(c.isFunction(a)?a():a),"replaceWith",a)},detach:function(a){return this.remove(a,true)},domManip:function(a,b,d){function f(u){return c.nodeName(u,"table")?u.getElementsByTagName("tbody")[0]||
u.appendChild(u.ownerDocument.createElement("tbody")):u}var e,j,i=a[0],o=[],k;if(!c.support.checkClone&&arguments.length===3&&typeof i==="string"&&ua.test(i))return this.each(function(){c(this).domManip(a,b,d,true)});if(c.isFunction(i))return this.each(function(u){var z=c(this);a[0]=i.call(this,u,b?z.html():w);z.domManip(a,b,d)});if(this[0]){e=i&&i.parentNode;e=c.support.parentNode&&e&&e.nodeType===11&&e.childNodes.length===this.length?{fragment:e}:sa(a,this,o);k=e.fragment;if(j=k.childNodes.length===
1?(k=k.firstChild):k.firstChild){b=b&&c.nodeName(j,"tr");for(var n=0,r=this.length;n<r;n++)d.call(b?f(this[n],j):this[n],n>0||e.cacheable||this.length>1?k.cloneNode(true):k)}o.length&&c.each(o,Qa)}return this}});c.fragments={};c.each({appendTo:"append",prependTo:"prepend",insertBefore:"before",insertAfter:"after",replaceAll:"replaceWith"},function(a,b){c.fn[a]=function(d){var f=[];d=c(d);var e=this.length===1&&this[0].parentNode;if(e&&e.nodeType===11&&e.childNodes.length===1&&d.length===1){d[b](this[0]);
return this}else{e=0;for(var j=d.length;e<j;e++){var i=(e>0?this.clone(true):this).get();c.fn[b].apply(c(d[e]),i);f=f.concat(i)}return this.pushStack(f,a,d.selector)}}});c.extend({clean:function(a,b,d,f){b=b||s;if(typeof b.createElement==="undefined")b=b.ownerDocument||b[0]&&b[0].ownerDocument||s;for(var e=[],j=0,i;(i=a[j])!=null;j++){if(typeof i==="number")i+="";if(i){if(typeof i==="string"&&!jb.test(i))i=b.createTextNode(i);else if(typeof i==="string"){i=i.replace(Ka,Ma);var o=(La.exec(i)||["",
""])[1].toLowerCase(),k=F[o]||F._default,n=k[0],r=b.createElement("div");for(r.innerHTML=k[1]+i+k[2];n--;)r=r.lastChild;if(!c.support.tbody){n=ib.test(i);o=o==="table"&&!n?r.firstChild&&r.firstChild.childNodes:k[1]==="<table>"&&!n?r.childNodes:[];for(k=o.length-1;k>=0;--k)c.nodeName(o[k],"tbody")&&!o[k].childNodes.length&&o[k].parentNode.removeChild(o[k])}!c.support.leadingWhitespace&&V.test(i)&&r.insertBefore(b.createTextNode(V.exec(i)[0]),r.firstChild);i=r.childNodes}if(i.nodeType)e.push(i);else e=
c.merge(e,i)}}if(d)for(j=0;e[j];j++)if(f&&c.nodeName(e[j],"script")&&(!e[j].type||e[j].type.toLowerCase()==="text/javascript"))f.push(e[j].parentNode?e[j].parentNode.removeChild(e[j]):e[j]);else{e[j].nodeType===1&&e.splice.apply(e,[j+1,0].concat(c.makeArray(e[j].getElementsByTagName("script"))));d.appendChild(e[j])}return e},cleanData:function(a){for(var b,d,f=c.cache,e=c.event.special,j=c.support.deleteExpando,i=0,o;(o=a[i])!=null;i++)if(d=o[c.expando]){b=f[d];if(b.events)for(var k in b.events)e[k]?
c.event.remove(o,k):Ca(o,k,b.handle);if(j)delete o[c.expando];else o.removeAttribute&&o.removeAttribute(c.expando);delete f[d]}}});var kb=/z-?index|font-?weight|opacity|zoom|line-?height/i,Na=/alpha\([^)]*\)/,Oa=/opacity=([^)]*)/,ha=/float/i,ia=/-([a-z])/ig,lb=/([A-Z])/g,mb=/^-?\d+(?:px)?$/i,nb=/^-?\d/,ob={position:"absolute",visibility:"hidden",display:"block"},pb=["Left","Right"],qb=["Top","Bottom"],rb=s.defaultView&&s.defaultView.getComputedStyle,Pa=c.support.cssFloat?"cssFloat":"styleFloat",ja=
function(a,b){return b.toUpperCase()};c.fn.css=function(a,b){return X(this,a,b,true,function(d,f,e){if(e===w)return c.curCSS(d,f);if(typeof e==="number"&&!kb.test(f))e+="px";c.style(d,f,e)})};c.extend({style:function(a,b,d){if(!a||a.nodeType===3||a.nodeType===8)return w;if((b==="width"||b==="height")&&parseFloat(d)<0)d=w;var f=a.style||a,e=d!==w;if(!c.support.opacity&&b==="opacity"){if(e){f.zoom=1;b=parseInt(d,10)+""==="NaN"?"":"alpha(opacity="+d*100+")";a=f.filter||c.curCSS(a,"filter")||"";f.filter=
Na.test(a)?a.replace(Na,b):b}return f.filter&&f.filter.indexOf("opacity=")>=0?parseFloat(Oa.exec(f.filter)[1])/100+"":""}if(ha.test(b))b=Pa;b=b.replace(ia,ja);if(e)f[b]=d;return f[b]},css:function(a,b,d,f){if(b==="width"||b==="height"){var e,j=b==="width"?pb:qb;function i(){e=b==="width"?a.offsetWidth:a.offsetHeight;f!=="border"&&c.each(j,function(){f||(e-=parseFloat(c.curCSS(a,"padding"+this,true))||0);if(f==="margin")e+=parseFloat(c.curCSS(a,"margin"+this,true))||0;else e-=parseFloat(c.curCSS(a,
"border"+this+"Width",true))||0})}a.offsetWidth!==0?i():c.swap(a,ob,i);return Math.max(0,Math.round(e))}return c.curCSS(a,b,d)},curCSS:function(a,b,d){var f,e=a.style;if(!c.support.opacity&&b==="opacity"&&a.currentStyle){f=Oa.test(a.currentStyle.filter||"")?parseFloat(RegExp.$1)/100+"":"";return f===""?"1":f}if(ha.test(b))b=Pa;if(!d&&e&&e[b])f=e[b];else if(rb){if(ha.test(b))b="float";b=b.replace(lb,"-$1").toLowerCase();e=a.ownerDocument.defaultView;if(!e)return null;if(a=e.getComputedStyle(a,null))f=
a.getPropertyValue(b);if(b==="opacity"&&f==="")f="1"}else if(a.currentStyle){d=b.replace(ia,ja);f=a.currentStyle[b]||a.currentStyle[d];if(!mb.test(f)&&nb.test(f)){b=e.left;var j=a.runtimeStyle.left;a.runtimeStyle.left=a.currentStyle.left;e.left=d==="fontSize"?"1em":f||0;f=e.pixelLeft+"px";e.left=b;a.runtimeStyle.left=j}}return f},swap:function(a,b,d){var f={};for(var e in b){f[e]=a.style[e];a.style[e]=b[e]}d.call(a);for(e in b)a.style[e]=f[e]}});if(c.expr&&c.expr.filters){c.expr.filters.hidden=function(a){var b=
a.offsetWidth,d=a.offsetHeight,f=a.nodeName.toLowerCase()==="tr";return b===0&&d===0&&!f?true:b>0&&d>0&&!f?false:c.curCSS(a,"display")==="none"};c.expr.filters.visible=function(a){return!c.expr.filters.hidden(a)}}var sb=J(),tb=/<script(.|\s)*?\/script>/gi,ub=/select|textarea/i,vb=/color|date|datetime|email|hidden|month|number|password|range|search|tel|text|time|url|week/i,N=/=\?(&|$)/,ka=/\?/,wb=/(\?|&)_=.*?(&|$)/,xb=/^(\w+:)?\/\/([^\/?#]+)/,yb=/%20/g,zb=c.fn.load;c.fn.extend({load:function(a,b,d){if(typeof a!==
"string")return zb.call(this,a);else if(!this.length)return this;var f=a.indexOf(" ");if(f>=0){var e=a.slice(f,a.length);a=a.slice(0,f)}f="GET";if(b)if(c.isFunction(b)){d=b;b=null}else if(typeof b==="object"){b=c.param(b,c.ajaxSettings.traditional);f="POST"}var j=this;c.ajax({url:a,type:f,dataType:"html",data:b,complete:function(i,o){if(o==="success"||o==="notmodified")j.html(e?c("<div />").append(i.responseText.replace(tb,"")).find(e):i.responseText);d&&j.each(d,[i.responseText,o,i])}});return this},
serialize:function(){return c.param(this.serializeArray())},serializeArray:function(){return this.map(function(){return this.elements?c.makeArray(this.elements):this}).filter(function(){return this.name&&!this.disabled&&(this.checked||ub.test(this.nodeName)||vb.test(this.type))}).map(function(a,b){a=c(this).val();return a==null?null:c.isArray(a)?c.map(a,function(d){return{name:b.name,value:d}}):{name:b.name,value:a}}).get()}});c.each("ajaxStart ajaxStop ajaxComplete ajaxError ajaxSuccess ajaxSend".split(" "),
function(a,b){c.fn[b]=function(d){return this.bind(b,d)}});c.extend({get:function(a,b,d,f){if(c.isFunction(b)){f=f||d;d=b;b=null}return c.ajax({type:"GET",url:a,data:b,success:d,dataType:f})},getScript:function(a,b){return c.get(a,null,b,"script")},getJSON:function(a,b,d){return c.get(a,b,d,"json")},post:function(a,b,d,f){if(c.isFunction(b)){f=f||d;d=b;b={}}return c.ajax({type:"POST",url:a,data:b,success:d,dataType:f})},ajaxSetup:function(a){c.extend(c.ajaxSettings,a)},ajaxSettings:{url:location.href,
global:true,type:"GET",contentType:"application/x-www-form-urlencoded",processData:true,async:true,xhr:A.XMLHttpRequest&&(A.location.protocol!=="file:"||!A.ActiveXObject)?function(){return new A.XMLHttpRequest}:function(){try{return new A.ActiveXObject("Microsoft.XMLHTTP")}catch(a){}},accepts:{xml:"application/xml, text/xml",html:"text/html",script:"text/javascript, application/javascript",json:"application/json, text/javascript",text:"text/plain",_default:"*/*"}},lastModified:{},etag:{},ajax:function(a){function b(){e.success&&
e.success.call(k,o,i,x);e.global&&f("ajaxSuccess",[x,e])}function d(){e.complete&&e.complete.call(k,x,i);e.global&&f("ajaxComplete",[x,e]);e.global&&!--c.active&&c.event.trigger("ajaxStop")}function f(q,p){(e.context?c(e.context):c.event).trigger(q,p)}var e=c.extend(true,{},c.ajaxSettings,a),j,i,o,k=a&&a.context||e,n=e.type.toUpperCase();if(e.data&&e.processData&&typeof e.data!=="string")e.data=c.param(e.data,e.traditional);if(e.dataType==="jsonp"){if(n==="GET")N.test(e.url)||(e.url+=(ka.test(e.url)?
"&":"?")+(e.jsonp||"callback")+"=?");else if(!e.data||!N.test(e.data))e.data=(e.data?e.data+"&":"")+(e.jsonp||"callback")+"=?";e.dataType="json"}if(e.dataType==="json"&&(e.data&&N.test(e.data)||N.test(e.url))){j=e.jsonpCallback||"jsonp"+sb++;if(e.data)e.data=(e.data+"").replace(N,"="+j+"$1");e.url=e.url.replace(N,"="+j+"$1");e.dataType="script";A[j]=A[j]||function(q){o=q;b();d();A[j]=w;try{delete A[j]}catch(p){}z&&z.removeChild(C)}}if(e.dataType==="script"&&e.cache===null)e.cache=false;if(e.cache===
false&&n==="GET"){var r=J(),u=e.url.replace(wb,"$1_="+r+"$2");e.url=u+(u===e.url?(ka.test(e.url)?"&":"?")+"_="+r:"")}if(e.data&&n==="GET")e.url+=(ka.test(e.url)?"&":"?")+e.data;e.global&&!c.active++&&c.event.trigger("ajaxStart");r=(r=xb.exec(e.url))&&(r[1]&&r[1]!==location.protocol||r[2]!==location.host);if(e.dataType==="script"&&n==="GET"&&r){var z=s.getElementsByTagName("head")[0]||s.documentElement,C=s.createElement("script");C.src=e.url;if(e.scriptCharset)C.charset=e.scriptCharset;if(!j){var B=
false;C.onload=C.onreadystatechange=function(){if(!B&&(!this.readyState||this.readyState==="loaded"||this.readyState==="complete")){B=true;b();d();C.onload=C.onreadystatechange=null;z&&C.parentNode&&z.removeChild(C)}}}z.insertBefore(C,z.firstChild);return w}var E=false,x=e.xhr();if(x){e.username?x.open(n,e.url,e.async,e.username,e.password):x.open(n,e.url,e.async);try{if(e.data||a&&a.contentType)x.setRequestHeader("Content-Type",e.contentType);if(e.ifModified){c.lastModified[e.url]&&x.setRequestHeader("If-Modified-Since",
c.lastModified[e.url]);c.etag[e.url]&&x.setRequestHeader("If-None-Match",c.etag[e.url])}r||x.setRequestHeader("X-Requested-With","XMLHttpRequest");x.setRequestHeader("Accept",e.dataType&&e.accepts[e.dataType]?e.accepts[e.dataType]+", */*":e.accepts._default)}catch(ga){}if(e.beforeSend&&e.beforeSend.call(k,x,e)===false){e.global&&!--c.active&&c.event.trigger("ajaxStop");x.abort();return false}e.global&&f("ajaxSend",[x,e]);var g=x.onreadystatechange=function(q){if(!x||x.readyState===0||q==="abort"){E||
d();E=true;if(x)x.onreadystatechange=c.noop}else if(!E&&x&&(x.readyState===4||q==="timeout")){E=true;x.onreadystatechange=c.noop;i=q==="timeout"?"timeout":!c.httpSuccess(x)?"error":e.ifModified&&c.httpNotModified(x,e.url)?"notmodified":"success";var p;if(i==="success")try{o=c.httpData(x,e.dataType,e)}catch(v){i="parsererror";p=v}if(i==="success"||i==="notmodified")j||b();else c.handleError(e,x,i,p);d();q==="timeout"&&x.abort();if(e.async)x=null}};try{var h=x.abort;x.abort=function(){x&&h.call(x);
g("abort")}}catch(l){}e.async&&e.timeout>0&&setTimeout(function(){x&&!E&&g("timeout")},e.timeout);try{x.send(n==="POST"||n==="PUT"||n==="DELETE"?e.data:null)}catch(m){c.handleError(e,x,null,m);d()}e.async||g();return x}},handleError:function(a,b,d,f){if(a.error)a.error.call(a.context||a,b,d,f);if(a.global)(a.context?c(a.context):c.event).trigger("ajaxError",[b,a,f])},active:0,httpSuccess:function(a){try{return!a.status&&location.protocol==="file:"||a.status>=200&&a.status<300||a.status===304||a.status===
1223||a.status===0}catch(b){}return false},httpNotModified:function(a,b){var d=a.getResponseHeader("Last-Modified"),f=a.getResponseHeader("Etag");if(d)c.lastModified[b]=d;if(f)c.etag[b]=f;return a.status===304||a.status===0},httpData:function(a,b,d){var f=a.getResponseHeader("content-type")||"",e=b==="xml"||!b&&f.indexOf("xml")>=0;a=e?a.responseXML:a.responseText;e&&a.documentElement.nodeName==="parsererror"&&c.error("parsererror");if(d&&d.dataFilter)a=d.dataFilter(a,b);if(typeof a==="string")if(b===
"json"||!b&&f.indexOf("json")>=0)a=c.parseJSON(a);else if(b==="script"||!b&&f.indexOf("javascript")>=0)c.globalEval(a);return a},param:function(a,b){function d(i,o){if(c.isArray(o))c.each(o,function(k,n){b||/\[\]$/.test(i)?f(i,n):d(i+"["+(typeof n==="object"||c.isArray(n)?k:"")+"]",n)});else!b&&o!=null&&typeof o==="object"?c.each(o,function(k,n){d(i+"["+k+"]",n)}):f(i,o)}function f(i,o){o=c.isFunction(o)?o():o;e[e.length]=encodeURIComponent(i)+"="+encodeURIComponent(o)}var e=[];if(b===w)b=c.ajaxSettings.traditional;
if(c.isArray(a)||a.jquery)c.each(a,function(){f(this.name,this.value)});else for(var j in a)d(j,a[j]);return e.join("&").replace(yb,"+")}});var la={},Ab=/toggle|show|hide/,Bb=/^([+-]=)?([\d+-.]+)(.*)$/,W,va=[["height","marginTop","marginBottom","paddingTop","paddingBottom"],["width","marginLeft","marginRight","paddingLeft","paddingRight"],["opacity"]];c.fn.extend({show:function(a,b){if(a||a===0)return this.animate(K("show",3),a,b);else{a=0;for(b=this.length;a<b;a++){var d=c.data(this[a],"olddisplay");
this[a].style.display=d||"";if(c.css(this[a],"display")==="none"){d=this[a].nodeName;var f;if(la[d])f=la[d];else{var e=c("<"+d+" />").appendTo("body");f=e.css("display");if(f==="none")f="block";e.remove();la[d]=f}c.data(this[a],"olddisplay",f)}}a=0;for(b=this.length;a<b;a++)this[a].style.display=c.data(this[a],"olddisplay")||"";return this}},hide:function(a,b){if(a||a===0)return this.animate(K("hide",3),a,b);else{a=0;for(b=this.length;a<b;a++){var d=c.data(this[a],"olddisplay");!d&&d!=="none"&&c.data(this[a],
"olddisplay",c.css(this[a],"display"))}a=0;for(b=this.length;a<b;a++)this[a].style.display="none";return this}},_toggle:c.fn.toggle,toggle:function(a,b){var d=typeof a==="boolean";if(c.isFunction(a)&&c.isFunction(b))this._toggle.apply(this,arguments);else a==null||d?this.each(function(){var f=d?a:c(this).is(":hidden");c(this)[f?"show":"hide"]()}):this.animate(K("toggle",3),a,b);return this},fadeTo:function(a,b,d){return this.filter(":hidden").css("opacity",0).show().end().animate({opacity:b},a,d)},
animate:function(a,b,d,f){var e=c.speed(b,d,f);if(c.isEmptyObject(a))return this.each(e.complete);return this[e.queue===false?"each":"queue"](function(){var j=c.extend({},e),i,o=this.nodeType===1&&c(this).is(":hidden"),k=this;for(i in a){var n=i.replace(ia,ja);if(i!==n){a[n]=a[i];delete a[i];i=n}if(a[i]==="hide"&&o||a[i]==="show"&&!o)return j.complete.call(this);if((i==="height"||i==="width")&&this.style){j.display=c.css(this,"display");j.overflow=this.style.overflow}if(c.isArray(a[i])){(j.specialEasing=
j.specialEasing||{})[i]=a[i][1];a[i]=a[i][0]}}if(j.overflow!=null)this.style.overflow="hidden";j.curAnim=c.extend({},a);c.each(a,function(r,u){var z=new c.fx(k,j,r);if(Ab.test(u))z[u==="toggle"?o?"show":"hide":u](a);else{var C=Bb.exec(u),B=z.cur(true)||0;if(C){u=parseFloat(C[2]);var E=C[3]||"px";if(E!=="px"){k.style[r]=(u||1)+E;B=(u||1)/z.cur(true)*B;k.style[r]=B+E}if(C[1])u=(C[1]==="-="?-1:1)*u+B;z.custom(B,u,E)}else z.custom(B,u,"")}});return true})},stop:function(a,b){var d=c.timers;a&&this.queue([]);
this.each(function(){for(var f=d.length-1;f>=0;f--)if(d[f].elem===this){b&&d[f](true);d.splice(f,1)}});b||this.dequeue();return this}});c.each({slideDown:K("show",1),slideUp:K("hide",1),slideToggle:K("toggle",1),fadeIn:{opacity:"show"},fadeOut:{opacity:"hide"}},function(a,b){c.fn[a]=function(d,f){return this.animate(b,d,f)}});c.extend({speed:function(a,b,d){var f=a&&typeof a==="object"?a:{complete:d||!d&&b||c.isFunction(a)&&a,duration:a,easing:d&&b||b&&!c.isFunction(b)&&b};f.duration=c.fx.off?0:typeof f.duration===
"number"?f.duration:c.fx.speeds[f.duration]||c.fx.speeds._default;f.old=f.complete;f.complete=function(){f.queue!==false&&c(this).dequeue();c.isFunction(f.old)&&f.old.call(this)};return f},easing:{linear:function(a,b,d,f){return d+f*a},swing:function(a,b,d,f){return(-Math.cos(a*Math.PI)/2+0.5)*f+d}},timers:[],fx:function(a,b,d){this.options=b;this.elem=a;this.prop=d;if(!b.orig)b.orig={}}});c.fx.prototype={update:function(){this.options.step&&this.options.step.call(this.elem,this.now,this);(c.fx.step[this.prop]||
c.fx.step._default)(this);if((this.prop==="height"||this.prop==="width")&&this.elem.style)this.elem.style.display="block"},cur:function(a){if(this.elem[this.prop]!=null&&(!this.elem.style||this.elem.style[this.prop]==null))return this.elem[this.prop];return(a=parseFloat(c.css(this.elem,this.prop,a)))&&a>-10000?a:parseFloat(c.curCSS(this.elem,this.prop))||0},custom:function(a,b,d){function f(j){return e.step(j)}this.startTime=J();this.start=a;this.end=b;this.unit=d||this.unit||"px";this.now=this.start;
this.pos=this.state=0;var e=this;f.elem=this.elem;if(f()&&c.timers.push(f)&&!W)W=setInterval(c.fx.tick,13)},show:function(){this.options.orig[this.prop]=c.style(this.elem,this.prop);this.options.show=true;this.custom(this.prop==="width"||this.prop==="height"?1:0,this.cur());c(this.elem).show()},hide:function(){this.options.orig[this.prop]=c.style(this.elem,this.prop);this.options.hide=true;this.custom(this.cur(),0)},step:function(a){var b=J(),d=true;if(a||b>=this.options.duration+this.startTime){this.now=
this.end;this.pos=this.state=1;this.update();this.options.curAnim[this.prop]=true;for(var f in this.options.curAnim)if(this.options.curAnim[f]!==true)d=false;if(d){if(this.options.display!=null){this.elem.style.overflow=this.options.overflow;a=c.data(this.elem,"olddisplay");this.elem.style.display=a?a:this.options.display;if(c.css(this.elem,"display")==="none")this.elem.style.display="block"}this.options.hide&&c(this.elem).hide();if(this.options.hide||this.options.show)for(var e in this.options.curAnim)c.style(this.elem,
e,this.options.orig[e]);this.options.complete.call(this.elem)}return false}else{e=b-this.startTime;this.state=e/this.options.duration;a=this.options.easing||(c.easing.swing?"swing":"linear");this.pos=c.easing[this.options.specialEasing&&this.options.specialEasing[this.prop]||a](this.state,e,0,1,this.options.duration);this.now=this.start+(this.end-this.start)*this.pos;this.update()}return true}};c.extend(c.fx,{tick:function(){for(var a=c.timers,b=0;b<a.length;b++)a[b]()||a.splice(b--,1);a.length||
c.fx.stop()},stop:function(){clearInterval(W);W=null},speeds:{slow:600,fast:200,_default:400},step:{opacity:function(a){c.style(a.elem,"opacity",a.now)},_default:function(a){if(a.elem.style&&a.elem.style[a.prop]!=null)a.elem.style[a.prop]=(a.prop==="width"||a.prop==="height"?Math.max(0,a.now):a.now)+a.unit;else a.elem[a.prop]=a.now}}});if(c.expr&&c.expr.filters)c.expr.filters.animated=function(a){return c.grep(c.timers,function(b){return a===b.elem}).length};c.fn.offset="getBoundingClientRect"in s.documentElement?
function(a){var b=this[0];if(a)return this.each(function(e){c.offset.setOffset(this,a,e)});if(!b||!b.ownerDocument)return null;if(b===b.ownerDocument.body)return c.offset.bodyOffset(b);var d=b.getBoundingClientRect(),f=b.ownerDocument;b=f.body;f=f.documentElement;return{top:d.top+(self.pageYOffset||c.support.boxModel&&f.scrollTop||b.scrollTop)-(f.clientTop||b.clientTop||0),left:d.left+(self.pageXOffset||c.support.boxModel&&f.scrollLeft||b.scrollLeft)-(f.clientLeft||b.clientLeft||0)}}:function(a){var b=
this[0];if(a)return this.each(function(r){c.offset.setOffset(this,a,r)});if(!b||!b.ownerDocument)return null;if(b===b.ownerDocument.body)return c.offset.bodyOffset(b);c.offset.initialize();var d=b.offsetParent,f=b,e=b.ownerDocument,j,i=e.documentElement,o=e.body;f=(e=e.defaultView)?e.getComputedStyle(b,null):b.currentStyle;for(var k=b.offsetTop,n=b.offsetLeft;(b=b.parentNode)&&b!==o&&b!==i;){if(c.offset.supportsFixedPosition&&f.position==="fixed")break;j=e?e.getComputedStyle(b,null):b.currentStyle;
k-=b.scrollTop;n-=b.scrollLeft;if(b===d){k+=b.offsetTop;n+=b.offsetLeft;if(c.offset.doesNotAddBorder&&!(c.offset.doesAddBorderForTableAndCells&&/^t(able|d|h)$/i.test(b.nodeName))){k+=parseFloat(j.borderTopWidth)||0;n+=parseFloat(j.borderLeftWidth)||0}f=d;d=b.offsetParent}if(c.offset.subtractsBorderForOverflowNotVisible&&j.overflow!=="visible"){k+=parseFloat(j.borderTopWidth)||0;n+=parseFloat(j.borderLeftWidth)||0}f=j}if(f.position==="relative"||f.position==="static"){k+=o.offsetTop;n+=o.offsetLeft}if(c.offset.supportsFixedPosition&&
f.position==="fixed"){k+=Math.max(i.scrollTop,o.scrollTop);n+=Math.max(i.scrollLeft,o.scrollLeft)}return{top:k,left:n}};c.offset={initialize:function(){var a=s.body,b=s.createElement("div"),d,f,e,j=parseFloat(c.curCSS(a,"marginTop",true))||0;c.extend(b.style,{position:"absolute",top:0,left:0,margin:0,border:0,width:"1px",height:"1px",visibility:"hidden"});b.innerHTML="<div style='position:absolute;top:0;left:0;margin:0;border:5px solid #000;padding:0;width:1px;height:1px;'><div></div></div><table style='position:absolute;top:0;left:0;margin:0;border:5px solid #000;padding:0;width:1px;height:1px;' cellpadding='0' cellspacing='0'><tr><td></td></tr></table>";
a.insertBefore(b,a.firstChild);d=b.firstChild;f=d.firstChild;e=d.nextSibling.firstChild.firstChild;this.doesNotAddBorder=f.offsetTop!==5;this.doesAddBorderForTableAndCells=e.offsetTop===5;f.style.position="fixed";f.style.top="20px";this.supportsFixedPosition=f.offsetTop===20||f.offsetTop===15;f.style.position=f.style.top="";d.style.overflow="hidden";d.style.position="relative";this.subtractsBorderForOverflowNotVisible=f.offsetTop===-5;this.doesNotIncludeMarginInBodyOffset=a.offsetTop!==j;a.removeChild(b);
c.offset.initialize=c.noop},bodyOffset:function(a){var b=a.offsetTop,d=a.offsetLeft;c.offset.initialize();if(c.offset.doesNotIncludeMarginInBodyOffset){b+=parseFloat(c.curCSS(a,"marginTop",true))||0;d+=parseFloat(c.curCSS(a,"marginLeft",true))||0}return{top:b,left:d}},setOffset:function(a,b,d){if(/static/.test(c.curCSS(a,"position")))a.style.position="relative";var f=c(a),e=f.offset(),j=parseInt(c.curCSS(a,"top",true),10)||0,i=parseInt(c.curCSS(a,"left",true),10)||0;if(c.isFunction(b))b=b.call(a,
d,e);d={top:b.top-e.top+j,left:b.left-e.left+i};"using"in b?b.using.call(a,d):f.css(d)}};c.fn.extend({position:function(){if(!this[0])return null;var a=this[0],b=this.offsetParent(),d=this.offset(),f=/^body|html$/i.test(b[0].nodeName)?{top:0,left:0}:b.offset();d.top-=parseFloat(c.curCSS(a,"marginTop",true))||0;d.left-=parseFloat(c.curCSS(a,"marginLeft",true))||0;f.top+=parseFloat(c.curCSS(b[0],"borderTopWidth",true))||0;f.left+=parseFloat(c.curCSS(b[0],"borderLeftWidth",true))||0;return{top:d.top-
f.top,left:d.left-f.left}},offsetParent:function(){return this.map(function(){for(var a=this.offsetParent||s.body;a&&!/^body|html$/i.test(a.nodeName)&&c.css(a,"position")==="static";)a=a.offsetParent;return a})}});c.each(["Left","Top"],function(a,b){var d="scroll"+b;c.fn[d]=function(f){var e=this[0],j;if(!e)return null;if(f!==w)return this.each(function(){if(j=wa(this))j.scrollTo(!a?f:c(j).scrollLeft(),a?f:c(j).scrollTop());else this[d]=f});else return(j=wa(e))?"pageXOffset"in j?j[a?"pageYOffset":
"pageXOffset"]:c.support.boxModel&&j.document.documentElement[d]||j.document.body[d]:e[d]}});c.each(["Height","Width"],function(a,b){var d=b.toLowerCase();c.fn["inner"+b]=function(){return this[0]?c.css(this[0],d,false,"padding"):null};c.fn["outer"+b]=function(f){return this[0]?c.css(this[0],d,false,f?"margin":"border"):null};c.fn[d]=function(f){var e=this[0];if(!e)return f==null?null:this;if(c.isFunction(f))return this.each(function(j){var i=c(this);i[d](f.call(this,j,i[d]()))});return"scrollTo"in
e&&e.document?e.document.compatMode==="CSS1Compat"&&e.document.documentElement["client"+b]||e.document.body["client"+b]:e.nodeType===9?Math.max(e.documentElement["client"+b],e.body["scroll"+b],e.documentElement["scroll"+b],e.body["offset"+b],e.documentElement["offset"+b]):f===w?c.css(e,d):this.css(d,typeof f==="string"?f:f+"px")}});A.jQuery=A.$=c})(window);
//--- end /usr/local/cpanel/base/cjt//jquery.js ---

//--- start /usr/local/cpanel/base/cjt//legacy.json.js ---
// Use of this file is depricated as of 11.28.   This file maintained only for
// legacy cloned themes.


// check to be sure the CPANEL global object already exists
if (typeof CPANEL == "undefined" || !CPANEL) {
    alert('You must include the CPANEL global object before including json.js!');
}
else if (typeof YAHOO.lang.JSON == "undefined" || !YAHOO.lang.JSON) {
    alert('You must include the YUI JSON library before including json.js!');
}
else {
    
/**
	The json module contains properties that reference json for our product.
	@module json
*/

/**
	The json class contains properties that reference json for our product.
	@class json
	@namespace CPANEL
	@extends CPANEL
*/
var NativeJson = Object.prototype.toString.call(this.JSON) === '[object JSON]' && this.JSON;

CPANEL.json = {

    // Native or YUI JSON Parser
    fastJsonParse: function (s, reviver) {
        return NativeJson ?  
        NativeJson.parse(s,reviver) : YAHOO.lang.JSON.parse(s,reviver);
    }


	
} // end json object
} // end else statement

//--- end /usr/local/cpanel/base/cjt//legacy.json.js ---

//--- start /usr/local/cpanel/base/cjt//nvdata.js ---
/*  
    #                                                 Copyright(c) 2010 cPanel, Inc.
    #                                                           All rights Reserved.
    # copyright@cpanel.net                                         http://cpanel.net
    # This code is subject to the cPanel license. Unauthorized copying is prohibited
*/ 

CPANEL.nvdata = {
	// set nvdata silently
	set : function(key, value) {
		var api2_call = {
			cpanel_jsonapi_version : 2,
			cpanel_jsonapi_module : "NVData",
			cpanel_jsonapi_func : "set",
			names : key
		};
		api2_call[key] = value;
		
		var callback = {
			success : function(o) { },
			failure : function(o) { }
		};
		
		YAHOO.util.Connect.asyncRequest("GET", CPANEL.urls.json_api(api2_call), callback, "");
	}
	
} // end nvdata object

//--- end /usr/local/cpanel/base/cjt//nvdata.js ---

//--- start /usr/local/cpanel/base/cjt//panels.js ---
/*  
    #                                                 Copyright(c) 2010 cPanel, Inc.
    #                                                           All rights Reserved.
    # copyright@cpanel.net                                         http://cpanel.net
    # This code is subject to the cPanel license. Unauthorized copying is prohibited
*/ 

// check to be sure the CPANEL global object already exists
if (typeof CPANEL == "undefined" || !CPANEL) {
    alert('You must include the CPANEL global object before including panels.js!');
}
else {
    
/**
	The panels module contains methods for creating and controlling help and modal panels.
	@module panels
*/

/**
	The panels class contains methods for creating and controlling help and modal panels.
	@class panels
	@namespace CPANEL
	@extends CPANEL
*/
CPANEL.panels = {
	
	/**
		An object of all the help panels.
		@property help_panels
	*/
	help_panels : {},
	
	/**
		Initialize a help panel and add an event listener to toggle it's display.
		@method create_help
		@param {DOM element} panel_el The DOM element to toggle the display of the panel.
		@param {DOM element} help_el The DOM element containing the help text.		
	*/
	create_help : function(panel_el, help_el) {
		
		// get the elements
		panel_el = YAHOO.util.Dom.get(panel_el);
		help_el = YAHOO.util.Dom.get(help_el);
			
		// destroy the panel if it already exists (ie: if we call create_help twice on the same page)
		if (this.help_panels[panel_el.id]) {
			this.help_panels[panel_el.id].destroy();
		}
		
		// create the panel
		var panel_id = panel_el.id + '_yuipanel';
		var panel_options = {
			width: "300px",
			visible: false,
			draggable: false,
			close: false,
			context: [ panel_el.id, 'tl', 'br', ["beforeShow", "windowResize", CPANEL.align_panels_event] ],
			effect: { effect: YAHOO.widget.ContainerEffect.FADE, duration : 0.25 }
		};
		this.help_panels[panel_el.id] = new YAHOO.widget.Panel(panel_id, panel_options);		
		
		// body
		this.help_panels[panel_el.id].setBody(help_el.innerHTML);			
		
		// footer
		var close_div_id = panel_el.id + '_yuipanel_close_div';
		var close_link_id = panel_el.id + '_yuipanel_close_link';
		var footer = '<div style="text-align: right">';
		footer += '<a id="' + close_link_id + '" href="javascript:void(0);">' + CPANEL.lang.close + '</a>';
		footer += '</div>';
		this.help_panels[panel_el.id].setFooter(footer);
		
		// render the panel
		this.help_panels[panel_el.id].render(document.body);
		
		// put the focus on the close link after the panel is shown
		this.help_panels[panel_el.id].showEvent.subscribe(function() { YAHOO.util.Dom.get(close_link_id).focus(); } );
		
		// add the "help_panel" style class to the panel
		YAHOO.util.Dom.addClass(panel_id, "help_panel");
		
		// add the event handlers to close the panel
		YAHOO.util.Event.on(close_link_id, "click", function() { CPANEL.panels.toggle_help(panel_el.id); });
		
		// add the event handler to the toggle element
		YAHOO.util.Event.on(panel_el.id, "click", function() { CPANEL.panels.toggle_help(panel_el.id); });
	},
	
	/**
		Toggle a single help panel.
		@method toggle_help
		@param {DOM element} el The id of the DOM element containing the help text.
	*/
	toggle_help : function(el) {
		if (this.help_panels[el].cfg.getProperty("visible") === true) {
			this.help_panels[el].hide();
		}
		else {
			this.hide_all_help();
			this.help_panels[el].show();
		}
	},
	
	/**
		Show a single help panel.
		@method show_help
		@param {DOM element} el The id of the DOM element containing the help text.
	*/
	show_help : function(el) {
		this.help_panels[el].show();
	},
	
	/**
		Hide a single help panel.
		@method hide_help
		@param {DOM element} el The id of the DOM element containing the help text.
	*/
	hide_help : function(el) {
		this.help_panels[el].hide();
	},
	
	/**
		Hides all help panels.
		@method hide_all_help
	*/
	hide_all_help : function() {
		for (var i in this.help_panels) {
			this.help_panels[i].hide();
		}
	}
	
} // end panels object
} // end else statement

//--- end /usr/local/cpanel/base/cjt//panels.js ---

//--- start /usr/local/cpanel/base/cjt//password.js ---
// check to be sure the CPANEL global object already exists
if (typeof CPANEL == "undefined" || !CPANEL) {
    alert('You must include the CPANEL global object before including password.js!');
}
else {
    
/**
	The password module contains methods used for random password generation, strength validation, etc
	@module password
*/

/**
	The password class contains methods used for random password generation, strength validation, etc
	@class password
	@namespace CPANEL
	@extends CPANEL 
*/
CPANEL.password = {

	// this function 
	setup : function(password1_el, password2_el, strength_bar_el, password_strength, create_strong_el, why_strong_link_el, why_strong_text_el) {
		
		// check that we have received enough arguments
		if (YAHOO.util.Dom.inDocument(password1_el) == false) alert("CPANEL.password.setup error: password1_el argument does not exist in the DOM!");
		if (YAHOO.util.Dom.inDocument(password2_el) == false) alert("CPANEL.password.setup error: password2_el argument does not exist in the DOM!");
		if (YAHOO.util.Dom.inDocument(strength_bar_el) == false) alert("CPANEL.password.setup error: strength_bar_el argument does not exist in the DOM!");
		if (CPANEL.validate.positive_integer(password_strength) == false) alert("CPANEL.password.setup error: password strength is not a positive integer!");
		
		// create the strength bar
		var password_bar = new CPANEL.password.strength_bar(strength_bar_el);
		
		// function to verify password strength
		var verify_password_strength = function() {
			if (password_bar.current_strength >= password_strength) return true;
			return false;
		};
		
		// update the strength bar when we type in the password field
		password_bar.attach(password1_el, verify_password_strength);
		
		// create a validator for password strength
		var strength_validator = new CPANEL.validate.validator(CPANEL.lang.password_strength);
		strength_validator.add(password1_el, verify_password_strength, CPANEL.lang.password_validator_strength + " " + password_strength + ".");
		strength_validator.add(password1_el, 'no_chars(%input%, " ")', CPANEL.lang.password_validator_no_spaces);
		if (password_strength != 0) {
			strength_validator.add(password1_el, 'min_length(%input%, 1)', CPANEL.lang.password_validator_no_empty);
		}
		strength_validator.attach();
		
		// create a validator for the two passwords matching
		var matching_validator = new CPANEL.validate.validator(CPANEL.lang.passwords_match);
		matching_validator.add(password2_el, "equals('" + password1_el + "', '" + password2_el + "')", CPANEL.lang.password_validator_no_match);
		matching_validator.attach();
		
		// create strong password link
		if (YAHOO.util.Dom.inDocument(create_strong_el) == true) {
			// function that executes when a user clicks the "use" button on the strong password dialog
			var fill_in_strong_password = function(strong_pass) {
				// fill in the two fields
				YAHOO.util.Dom.get(password1_el).value = strong_pass;
				YAHOO.util.Dom.get(password2_el).value = strong_pass;
				
				// verify the matching validator
				matching_validator.verify();
				
				// update the strength bar
				password_bar.check_strength(password1_el, function() {
					// verify the password strength
					strength_validator.verify();
				});
			};
			
			// add an event handler for the "create strong password" link
			YAHOO.util.Event.on(create_strong_el, "click", function() {
				CPANEL.password.generate_password(fill_in_strong_password);
			});
		}
		
		// add an event handler for the "why?" link
		if (YAHOO.util.Dom.inDocument(why_strong_link_el) == true && YAHOO.util.Dom.inDocument(why_strong_text_el) == true) {
			CPANEL.panels.create_help(why_strong_link_el, why_strong_text_el);
		}		
		
		// return the two validator objects we created
		return [strength_validator, matching_validator];
	},

	strength_bar : function(el) {
	
		// save each request so that we can cancel the last one when we fire off a new one
		this.ajax_request;
	
		// get the password bar element
		if (YAHOO.util.Dom.inDocument(el) == false) {
			alert('Failed to initialize password strength bar.' + "\n" + 'Could not find ' + el + ' in the DOM.');
		}
		this.strength_bar_el = YAHOO.util.Dom.get(el);
	
		// initialize the password strength at 0
		this.current_strength = 0;
		CPANEL.password.show_strength_bar(this.strength_bar_el, 0);
	
		// store the last password checked so we don't have hit the server for the same phrase multiple times
		this.last_password_checked = '';
	
		// attach the password bar to an input field
		this.attach = function(input_el, callback_function) {
		
			if (YAHOO.util.Dom.inDocument(input_el) == false) {
				alert("Failed to attach strength bar object.\n Could not find " + input_el + "in the DOM.");
			}
			else {
				// if no callback function was added create one that does nothing
				if (typeof(callback_function) === 'undefined') {
					callback_function = function() {};
				}
				
				// add an event handler to the input field
				YAHOO.util.Event.on(input_el, "keyup", keyup_listener, { "input_el" : input_el, "func" : callback_function });
			}
		};
		
		// reset the bar
		this.destroy = function() {
			this.strength_bar_el.innerHTML = '';
			this.current_strength = 0;
			this.last_password_checked = '';
		};
		
		// public wrapper for the check strength function 
		this.check_strength = function(input_el, callback_function) {
			_check_strength(null, { "input_el" : input_el, "func" : callback_function });
		};
		
		// PRIVATE METHODS
		var that = this;

        var pw_strength_timeout;
        var keyup_listener = function(e, o) {
            clearTimeout(pw_strength_timeout);

            // if a request is currently active cancel it
            if (YAHOO.util.Connect.isCallInProgress(that.ajax_request)) {
                YAHOO.util.Connect.abort(that.ajax_request);
            }

            var password = DOM.get(o.input_el).value;

            if ( password in cached_strengths ) {
                that.current_strength = cached_strengths[password];
                that.last_password_checked = password;
                _update_strength_bar( cached_strengths[password] );
                o.func();
            }
            else {
                pw_strength_timeout = setTimeout( function() { _check_strength(e, o) }, CPANEL.password.keyup_delay_ms );
            }
        };

        var cached_strengths = { "":0 };
		
		// check the strength of the password
		var _check_strength = function(e, o) {
		

            //show a loading indicator
            _update_strength_bar(null);

			// set the value
			var password = YAHOO.util.Dom.get(o.input_el).value;
			
			// create the callback functions
			var callback = {
				success : function(o2) {
					// the responseText should be JSON data
					try {
						var response = YAHOO.lang.JSON.parse(o2.responseText);
					}
					catch (e) {
						// TODO: write CPANEL.errors.json();
						alert("JSON Parse Error: Please refresh the page and try again.");
						return;
					}
					
					// make sure strength is an integer between 0 and 100
					var strength = parseInt(response.strength);
					
                    if (strength < 0) {
                        strength = 0;
                    }
                    else if (strength > 100) {
                        strength = 100;
                    }

                    cached_strengths[password] = strength;

                    that.last_password_checked = password;

					that.current_strength = strength;
					
					_update_strength_bar(strength);
					
					// run the callback function
					o.func();
				},

				failure : function(o2) {
					var error = '<table style="width: 100%; height: 100%; padding: 0px; margin: 0px"><tr>';
					error += '<td style="padding: 0px; margin: 0px; text-align: center" valign="middle">AJAX Error: Try Again</td>';
					error += '</tr></table>';
					YAHOO.util.Dom.get(that.strength_bar_el).innerHTML = error;
				}
			};
		  
			// if a request is currently active cancel it
			if (YAHOO.util.Connect.isCallInProgress(that.ajax_request)) {
				YAHOO.util.Connect.abort(that.ajax_request);
			}
		  
			// send the AJAX request
			var url = CPANEL.urls.password_strength();
            that.ajax_request = YAHOO.util.Connect.asyncRequest('POST', url, callback, "password=" + encodeURIComponent(password) );
		};
		
		var _update_strength_bar = function(strength) {
			CPANEL.password.show_strength_bar(that.strength_bar_el, strength);
		};
	},
	
	/**
		Shows a password strength bar for a given strength.
		@method show_strength_bar
		@param {DOM element} el The DOM element to put the bar.  Should probably be a div.
		@param {integer, null} strength The strength of the bar, or null for "updating".
	*/
	show_strength_bar : function(el, strength) {
		
		el = YAHOO.util.Dom.get(el);
		
		// NOTE: it would probably be more appropriate to move these colors into a CSS file, but I want the CJT to be self-contained.  this solution is fine for now
		var phrase, color;
        if (strength === null) {
            phrase = CPANEL.lang.ajax_loading;
        }
        else if (strength >= 80) {
            phrase = CPANEL.lang.strength_phrase_very_strong;
            color = '#8FFF00';    // lt green
        }
        else if (strength >= 60) {
            phrase = CPANEL.lang.strength_phrase_strong;
            color = '#C5FF00';    // chartreuse
        }
        else if (strength >= 40) {
            phrase = CPANEL.lang.strength_phrase_ok;
            color = '#F1FF4D';    // yellow
        }
        else if (strength >= 20) {
            phrase = CPANEL.lang.strength_phrase_weak;
            color = '#FF9837';    // orange
        }
        else if (strength >= 0) {
            phrase = CPANEL.lang.strength_phrase_very_weak;
            color = '#FF0000';    // red
        }
		
		var html;
		// container div with relative positioning, height/width set to 100% to fit the container element
		html  = '<div style="position: relative; width: 100%; height: 100%">';
		
        // phrase div fits the width and height of the container div and has its text vertically and horizontally centered; has a z-index of 1 to put it above the color bar div
        html += '<div style="position: absolute; left: 0px; width: 100%; height: 100%; text-align: center; z-index: 1; padding: 0px; margin: 0px' + (strength === null ? '; font-style:italic; color:graytext' : '') + '">';
        html += '<table style="width: 100%; height: 100%; padding: 0px; margin: 0px"><tr style="padding: 0px; margin: 0px"><td valign="middle" style="padding: 0px; margin: 0px">' + phrase + ( strength !== null ? (' (' + strength + '/100)') : "" ) + '</td></tr></table>';  // use a table to vertically center for greatest compatibility
		html += '</div>';
		
        if ( strength !== null ) {
            // color bar div fits the width and height of the container div and width changes depending on the strength of the password
            html += '<div style="position: absolute; left: 0px; width: ' + strength + '%; height: 100%; background-color: ' + color + ';"></div>';
        }
		
		// close the container div
		html += '</div>';
		
		el.innerHTML = html;
	},

    //Time in ms between last keyup and sending off the password strength CGI
    //AJAX call. Useful to prevent an excess of aborted CGI calls.
    keyup_delay_ms : 500,

	
	/**
		Creates a strong password
		@method create_password
		@param {object} options (optional) options to specify limitations on the password
		@return {string} a strong password
	*/
	create_password : function(options) {

		// set the length
		var length;
		if (CPANEL.validate.positive_integer(options.length) == false) length = 12;
		else length = options.length;
		
		// possible password characters
		var uppercase = "ABCDEFGHIJKLMNOPQRSTUVWXTZ";
		var lowercase = "abcdefghiklmnopqrstuvwxyz";
		var numbers = "0123456789";
		var symbols = "!@#$%^&*()-_=+{}[];,.?~";
		
		var chars = '';
		if (options.uppercase == true) chars += uppercase;
		if (options.lowercase == true) chars += lowercase;
		if (options.numbers == true) chars += numbers;
		if (options.symbols == true) chars += symbols;

		// generate the thing
		var password = '';
		for (var i=0; i<length; i++) {
			var rnum = Math.floor(Math.random() * chars.length);
			password += chars.substring(rnum, rnum + 1);
		}
		
		return password;
	},
	
	/**
		Pops up a modal dialog box containing a strong password.
		@method generate_password
		@param {function} use_password_function A function that gets executed when the user clicks the "Use Password" button on the modal box.  The function will have the password string sent to it as it's first argument.
		@param {integer} length (optional) the length of the random password to generate.  defaults to 15
		launch_el - the element you clicked on to launch the password generator (it appears relative to this element)
	*/
	generate_password : function(use_password_function, length) {
		
		// create the password
		var default_options = {
			length : 12,
			uppercase : true,
			lowercase : true,
			numbers : true,
			symbols : true
		};
		var password = this.create_password(default_options);
		
		// remove the panel if it already exists
		if (YAHOO.util.Dom.inDocument("generate_password_panel") == true) {
			var remove_me = YAHOO.util.Dom.get("generate_password_panel");
			YAHOO.util.Event.purgeElement(remove_me, true);
			remove_me.parentNode.removeChild(remove_me);
		}

        // create the panel
        var panel_options = {
            width:       "380px",
            fixedcenter: true,
            close:       true,
            draggable:   false,
            zindex:      1000,
            visible:     true,
            modal:       true,
            effect:      { effect: CPANEL.animate.ContainerEffect.FADE_MODAL, duration : 0.25 }
        };
		var panel = new YAHOO.widget.Panel("generate_password_panel", panel_options);
		
		// header
		var header = '<div class="hd"><div class="lt"></div>';
		header += '<span>' + CPANEL.lang.password_generator + '</span>';
		header += '<div class="rt"></div></div>';
		panel.setHeader(header);
		
		// body
		var body = '<div id="generate_password_body_div">';
		
		body += '<table id="generate_password_table">';
		body += '<tr>';
		body +=		'<td><input id="generate_password_input_field" type="text" value="' + password + '" size="27"  /></td>';
		body += '</tr>';
		body += '<tr>';
		body += 	'<td><input type="button" class="input-button" value="' + CPANEL.lang.generate_password + '" id="generate_password_reload" /></td>';
		body +=	'</tr>';
		body += '<tr>';
		body += 	'<td><span class="action_link" id="generate_password_toggle_advanced_options">' + CPANEL.lang.advanced + ' &raquo;</span>';

		body += '<div id="generate_password_advanced_options" style="display: none"><table style="width: 100%">';
		body += '<tr>'
		body += 	'<td colspan="2">' + CPANEL.lang.length + ': <input type="text" id="generate_password_length" size="2" maxlength="2" value="12" /> (10-18)</td>';
		body += '</tr>';		
		body += '<tr>';
		body += 	'<td width="50%">' + CPANEL.lang.alpha_characters + ':</td>';
		body += 	'<td width="50%">' + CPANEL.lang.nonalpha_characters + ':</td>';
		body += '</tr><tr>';
		body += 	'<td><input type="radio" name="generate_password_alpha" id="generate_password_mixed_alpha" checked="checked" /> <label for="generate_password_mixed_alpha">' + CPANEL.lang.both + ' (aBcD)</label></td>';
		body += 	'<td><input type="radio" name="generate_password_nonalpha" id="generate_password_mixed_nonalpha" checked="checked" /> <label for="generate_password_mixed_nonalpha">' + CPANEL.lang.both + ' (1@3$)</label></td>';
		body += '</tr><tr>';
		body += 	'<td><input type="radio" name="generate_password_alpha" id="generate_password_lowercase" /> <label for="generate_password_lowercase">' + CPANEL.lang.lowercase + ' (abc)</label></td>';
		body += 	'<td><input type="radio" name="generate_password_nonalpha" id="generate_password_numbers" /> <label for="generate_password_numbers">' + CPANEL.lang.numbers + ' (123)</label></td>';
		body += '</tr><tr>';
		body += 	'<td><input type="radio" name="generate_password_alpha" id="generate_password_uppercase" /> <label for="generate_password_uppercase">' + CPANEL.lang.uppercase + ' (ABC)</label></td>';
		body += 	'<td><input type="radio" name="generate_password_nonalpha" id="generate_password_symbols" /> <label for="generate_password_symbols">' + CPANEL.lang.symbols + ' (@#$)</label></td>';
		body += '</tr>';
		body +=	'</table></div>';
		
		body +=	'</td></tr></table>';
		
		body += '<p><input type="checkbox" id="generate_password_confirm" /> <label for="generate_password_confirm">' + CPANEL.lang.confirm_copy_password + '</label></p>';
		
		body += '<div id="generate_password_action_div">';
		body += '<span id="generate_password_cancel_link" class="action_link" style="margin-right: 8px">' + CPANEL.lang.cancel + '</span><input id="generate_password_use_button" type="button" class="input-button" disabled="disabled" value="' + CPANEL.lang.use_password + '" />';
		body += '</div>';
		
		body += '</div>';
		panel.setBody(body);
		
		// render the panel
		panel.render(document.body);
		
		// make sure the input button is not checked (defeat browser caching)
		YAHOO.util.Dom.get("generate_password_confirm").checked = false;
		
		// add event handlers for actions on the panel
		// use the random password
		YAHOO.util.Event.on("generate_password_use_button", "click", function() { 	
			panel.hide(); 
			use_password_function(YAHOO.util.Dom.get("generate_password_input_field").value); 
		});
		
		YAHOO.util.Event.on("generate_password_confirm", "click", function() {
			if (YAHOO.util.Dom.get("generate_password_confirm").checked == true) {
				YAHOO.util.Dom.get("generate_password_use_button").disabled = false;
			}
			else {
				YAHOO.util.Dom.get("generate_password_use_button").disabled = true;
			}
		});
		
		// select the input field when the user clicks on it
		YAHOO.util.Event.on("generate_password_input_field", "click", function() { 
			YAHOO.util.Dom.get("generate_password_input_field").select(); 
		});
		
		YAHOO.util.Event.on("generate_password_toggle_advanced_options", "click", function() { $("#generate_password_advanced_options").slideToggle(CPANEL.JQUERY_ANIMATION_SPEED); });
		
		// get the password options from the interface
		var get_password_options = function() {
			var options = {};
			
			var length_el = YAHOO.util.Dom.get("generate_password_length");
			var length = length_el.value;
			if (CPANEL.validate.positive_integer(length) == false) length = 12;
			else if (length < 10) length = 10;
			else if (length > 18) length = 18;
			length_el.value = length;
			options.length = length;
			
			if (YAHOO.util.Dom.get("generate_password_mixed_alpha").checked == true) {
				options.uppercase = true;
				options.lowercase = true;
			}
			else {
				options.uppercase = YAHOO.util.Dom.get("generate_password_uppercase").checked;
				options.lowercase = YAHOO.util.Dom.get("generate_password_lowercase").checked;
			}
			
			if (YAHOO.util.Dom.get("generate_password_mixed_nonalpha").checked == true) {
				options.numbers = true;
				options.symbols = true;
			}
			else {
				options.numbers = YAHOO.util.Dom.get("generate_password_numbers").checked;
				options.symbols = YAHOO.util.Dom.get("generate_password_symbols").checked;
			}
			
			return options;
		};		
		
		// generate a new password and select the input field text when the user clicks the refresh text
		var generate_new_password = function() {
			YAHOO.util.Dom.get("generate_password_input_field").value = CPANEL.password.create_password(get_password_options()); 
		};
                if (this.beforeExtendPanel) {
                   this.beforeExtendPanel();
                   YAHOO.util.Dom.get("generate_password_input_field").value = CPANEL.password.create_password(get_password_options());
                }

		YAHOO.util.Event.on("generate_password_reload", "click", generate_new_password);
		
		// hide the panel if the user checks the cancel button
		YAHOO.util.Event.on("generate_password_cancel_link", "click", function() {
			panel.hide();
		});
		
		// watch the advanced options inputs
		var password_options = [
								"generate_password_mixed_alpha", "generate_password_uppercase", "generate_password_lowercase",
								"generate_password_mixed_nonalpha", "generate_password_numbers", "generate_password_symbols"
								];
		YAHOO.util.Event.on(password_options, "change", generate_new_password);
	}
    
} // end password object
} // end else statement

//--- end /usr/local/cpanel/base/cjt//password.js ---

//--- start /usr/local/cpanel/base/cjt//table2.js ---
/*  
    #                                                 Copyright(c) 2010 cPanel, Inc.
    #                                                           All rights Reserved.
    # copyright@cpanel.net                                         http://cpanel.net
    # This code is subject to the cPanel license. Unauthorized copying is prohibited
*/ 

// check to be sure the CPANEL global object already exists
if (typeof(CPANEL) === "undefined" || ! CPANEL) {
    alert('You must include the CPANEL global object before including table2.js!');
}
else {

//el: string or DOM object
//data: array of objects
//animate_render: boolean
//
//columns: array of objects, e.g.:
//{
//  key: 'user',                    //required
//  label: 'Username',              //optional
//  renderer: function(row,i) {..}  //optional
//}
//"renderer" receives the data row and index and must return a String object
//
//actions: array of objects { label: "", code: function(row,i) {..} }
//each function receives the data row and index as its parameters
CPANEL.table2 = function( table_opts ) {
    for (var i in table_opts) this[i] = table_opts[i];

    this.columns = this.columns.map( function(col_data) {
        var key = col_data.key;
        if ( !('renderer' in col_data) ) col_data.renderer = function(row) { return row[key] };
        if ( !('label'    in col_data) ) col_data.label    = key;

        return col_data;
    } );

    var need_to_render_head = true;
    if ( 'el' in this ) {
        if ( typeof this.el === "string" ) {
            this.id = this.el;
            this.el = DOM.get(this.el);
        }
        else {
            this.id = this.el.id || DOM.generateId(this.el);
        }
        this.head = this.el.tHead;
        if ( !this.head ) {
            this.head = document.createElement('thead');
            this.foot = document.createElement('tfoot');
            this.el.insertBefore(this.foot,this.el.firstChild);
            this.el.insertBefore(this.head,this.el.firstChild);
        }
        else {
            need_to_render_head = false;
        }
        var tBodies = this.el.tBodies;
        if ( tBodies && tBodies.length > 0 ) {
            this.body = tBodies[0];
        }
        else {
            this.body = document.createElement('tbody');
            this.el.appendChild(this.body);
        }
    }
    else {
        this.el = document.createElement('table');
        this.id = DOM.generateId(this.el);
        this.head = document.createElement('thead');
        this.body = document.createElement('tbody');
    }

    DOM.addClass(this.el, 'cjt-table');

    this.constructor.tables[this.id] = this;
    this._encoded_id = this.id.html_encode();

    if ( !('animate_render' in this) ) this.animate_render = true;
this.animate_render = false;  //for now, until/if I get it working

    if (need_to_render_head) this.render_head();

    if ('data' in this) this.render();
};

//id => JS object
CPANEL.table2.tables = {};

YAHOO.lang.augmentObject( CPANEL.table2.prototype, {
    //requires this.data
    render : function() {
        var that = this;

        if ( 'actions' in this ) {
            var actions_html = this.actions.map( function(action, action_index) {
                return YAHOO.lang.substitute( that._action_item_template, {action_label:action.label.html_encode(), action_index:action_index, table_id:that._encoded_id} );
            } ).join("");

            this._actions_html = "<ul class='cjt-table-action-list'>"+actions_html+"</ul>";

            this.data.forEach( function(d,i) { that._cached_forms[i] = {} } );
        }

        //this may be faster combining the reduce() and forEach()
        this.data
            .map( function(row,idx) { return that._generate_row_objects.call(that,row,idx); } )
            .reduce( function(a,b) { return a.concat(b); }, [] )     //flatten the list
            .forEach( function(row) { that.body.appendChild(row) } )
        ;

        //accommodate touch screens!!
        if ( !CPANEL.is_touchscreen && ('actions' in this) ) {
            this._show_actions(0);
        }

        if ( this.animate_render ) Array.prototype.filter.call( this.body.rows, function(r) {
            return !DOM.hasClass(r, 'cjt-table-form-row')
        } )
        .forEach( function(r) { Array.prototype.filter.call(r,CPANEL.animate.slide_down) } );
    },
    render_head : function() {
        var that=this;
        var column_headers = this.columns.map( function(col) {
            var th = document.createElement('th');
            th.id = that.id+'-head-cell-'+col.key;
            th.innerHTML = col.label;
            return th;
        } );

        //IE can't handle injecting rows via innerHTML
        var the_row = document.createElement('tr');
        the_row.id = this.id+'-head-row';
        the_row.className = 'cjt-table-head-row';
        column_headers.forEach( function(h) { the_row.appendChild(h) } );
        this.head.appendChild(the_row);
    },
    render_action : function(action, data_index) {
        var form_cell = this._get_form_cell(data_index);

        //form elements are always wrapped in a div
        var existing_form_contents = form_cell.firstChild;

        if ( existing_form_contents ) {
            this._cached_forms[data_index][action.label] = existing_form_contents;

            CPANEL.animate.slide_up_and_remove(form_cell.firstChild);

            if ( (data_index in this._open_forms) && this._open_forms[data_index] === action.label ) {
                delete this._open_forms[data_index];
                return;
            }
        }


        var form_div = (data_index in this._cached_forms) && this._cached_forms[data_index][action.label];
        if ( !form_div ) {
            form_div = document.createElement('div');
            form_div.innerHTML = action.code(this.data[data_index], data_index);
            DOM.addClass(form_div, 'cjt-table-form');
            DOM.setStyle(form_div, 'display', 'none');
        }

        form_cell.appendChild(form_div);
        CPANEL.animate.slide_down(form_div);
        this._open_forms[data_index] = action.label;
    },
    reset : function() {
        for ( var open_index in this._open_forms ) {
            var form_cell = _get_form_cell(open_index);
            var contents = form_cell.childNodes;
            if (contents) Array.prototype.forEach.call(contents, CPANEL.animate.slide_up_and_remove);
        }
    },

    //row_index => action label => HTML
    _cached_forms : {},

    //row index => action label
    _open_forms : {},

    _get_form_cell : function(i) { return DOM.get(this.id + '-form-cell-' + i) },

    _action_item_template : "<li class=\"cjt-table-action-{action_label}\" onclick='CPANEL.table2.tables[\"{table_id}\"].render_action(CPANEL.table2.tables[\"{table_id}\"].actions[{action_index}],{d_index})'>{action_label}</li>",

    _generate_row_objects : function(row_data,row_index) {
        var data_cells = this.columns.map( function(col_data, col_index) {
            var key = col_data.key;
            var cell = document.createElement('td');
            if ( this.animate_render ) cell.style.height = '0';
            cell.className = 'cjt-table-data-cell-'+col_data.key;
            cell.innerHTML = col_data.renderer( row_data, row_index );
            return cell;
        } );

        var stripe_class = row_index % 2 ? 'row-odd' : 'row-even';
        var row_class = ['cjt-table-data-row',stripe_class];

        var row_events = {};
        if ( this._actions_html ) {
            var that=this;
            if ( CPANEL.is_touchscreen ) {
                row_events.ontouchstart = function() { that._toggle_actions(row_index) };
            }
            else {
                row_events.onmouseover = function() { that._show_actions(row_index) };
            }
            row_class.push('cjt-table-data-row-with-actions');
        }

        var main_row = document.createElement('tr');
        main_row.id = this.id+'-data-row-'+row_index;
        main_row.className = row_class.join(' ');
        data_cells.forEach( function(c) { main_row.appendChild(c) } );

        var rows = [main_row];

        if ( this._actions_html ) {
            var click_row = document.createElement('tr');
            click_row.id = this.id+'-click-row-'+row_index;
            click_row.className = 'cjt-table-click-row '+stripe_class;
            var click_row_cell = document.createElement('td');
            click_row_cell.colSpan = 99;
            click_row_cell.innerHTML = YAHOO.lang.substitute( this._actions_html+'', { 'd_index':row_index } );
            click_row.appendChild(click_row_cell);

            var form_row = document.createElement('tr');
            form_row.id = this.id+'-form-row-'+row_index;
            form_row.className = 'cjt-table-form-row '+stripe_class;
            var form_row_cell = document.createElement('td');
            form_row_cell.id = this.id+'-form-cell-'+row_index;
            form_row_cell.colSpan = 99;
            form_row.appendChild(form_row_cell);

            rows.push(click_row, form_row);
        }

        //assign events as needed
        for ( var ev in row_events ) {
            rows.forEach( function(r) { r[ev] = row_events[ev] } );
        }

        return rows;
    },

    _shown_actions_index : null,
    _show_actions : function(row_index) {
        if ( row_index !== this._shown_actions_index ) {
            this._hide_actions(this._shown_actions_index);
            DOM.addClass( this.id+'-click-row-'+row_index, 'actions_visible' );
            this._shown_actions_index = row_index;
        }
    },
    _hide_actions : function(row_index) {
        DOM.removeClass( this.id+'-click-row-'+row_index, 'actions_visible' );
    },
    _toggle_actions : function(row_index) {
        if ( row_index === this._shown_actions_index ) {
            this._hide_actions(row_index);
            this._shown_actions_index = null;
        }
        else {
            this._show_actions(row_index);
        }
    },

    _ : true  //does nothing
} );


(function() {
    var _stylesheet = [
        ['.cjt-table-form-cell', 'padding: 0px '],
        ['.cjt-table-action', 'float:left; cursor:pointer'],
        ['.cjt-table-action-list', 'visibility:hidden; list-style:none; padding:0; margin:0'],
        ['.cjt-table-click-row.actions_visible ul', 'visibility:visible']
    ];
    var inserter;
    var first_stylesheet = document.styleSheets[0];
    if (!first_stylesheet) {
        var new_stylesheet = document.createElement('style');
        document.head.appendChild(new_stylesheet);
        first_stylesheet = document.styleSheets[0];
    }
    if ('insertRule' in first_stylesheet) { //W3C DOM
        _stylesheet.forEach( function(rule) {
            first_stylesheet.insertRule( rule[0] + ' {'+rule[1]+'}', 0 );
        } );
    }
    else { //IE
        _stylesheet.forEach( function(rule) {
            first_stylesheet.addRule( rule[0], rule[1], 0 );
        } );
    }
})();

CPANEL.table2.Tree = function(name) { this.name = name };

}

//--- end /usr/local/cpanel/base/cjt//table2.js ---

//--- start /usr/local/cpanel/base/cjt//urls.js ---
/*  
    #                                                 Copyright(c) 2010 cPanel, Inc.
    #                                                           All rights Reserved.
    # copyright@cpanel.net                                         http://cpanel.net
    # This code is subject to the cPanel license. Unauthorized copying is prohibited
*/ 

// check to be sure the CPANEL global object already exists
if (typeof CPANEL == "undefined" || !CPANEL) {
    alert('You must include the CPANEL global object before including urls.js!');
}
else {
    
/**
	The urls module contains URLs for AJAX calls.
	@module urls
*/

/**
	The urls class URLs for AJAX calls.
	@class urls
	@namespace CPANEL
	@extends CPANEL
*/
CPANEL.urls = {
	
	/**
		URL for the password strength AJAX call.<br />
		GET request<br />
		arg1: password=password
		@property password_strength
		@type string
	*/
	password_strength : function() {
        return CPANEL.security_token + "/backend/passwordstrength.cgi";
    },
	
	// build a JSON API call from an object
	json_api : function(object) {
		
		// build the query string
		var query_string = '';
		for (var item in object) {
                   if (object.hasOwnProperty(item)) {
			query_string += encodeURIComponent(item) + '=' + encodeURIComponent(object[item]) + '&';
                   }
		}
		
		// add some salt to prevent browser caching		
		query_string += 'cache_fix=' + new Date().getTime();
		
		return CPANEL.security_token + '/json-api/cpanel?' + query_string;
	},
	
	whm_api : function(script, params, api_mode) {
		if (! api_mode) {
			api_mode = "json-api";
		}
		else if (api_mode == "xml") {
			api_mode = "xml-api";
		}

		// build the query string
		// TODO: turn this into a general object->query string function
		// 		 also have a query params -> object function
		var query_string = '';
		for (var item in params) {
                   if (params.hasOwnProperty(item)) {
			query_string += encodeURIComponent(item) + '=' + encodeURIComponent(params[item]) + '&';
                   }
		}
		
		// add some salt to prevent browser caching		
		query_string += 'cache_fix=' + new Date().getTime();		
		
		return CPANEL.security_token + "/" + api_mode + "/" + script + "?" + query_string;
	}
	
} // end urls object
} // end else statement

//--- end /usr/local/cpanel/base/cjt//urls.js ---

//--- start /usr/local/cpanel/base/cjt//util.js ---
/*  
    #                                                 Copyright(c) 2010 cPanel, Inc.
    #                                                           All rights Reserved.
    # copyright@cpanel.net                                         http://cpanel.net
    # This code is subject to the cPanel license. Unauthorized copying is prohibited
*/ 

// check to be sure the CPANEL global object already exists
if (typeof CPANEL == "undefined" || !CPANEL) {
    alert('You must include the CPANEL global object before including util.js!');
}
else {
/**
	The util module contains miscellaneous utilities.
	@module array
*/

/**
	The util module contains miscellaneous utilities.
	@class util
	@namespace CPANEL
	@extends CPANEL
*/
if ( !('util' in CPANEL) ) CPANEL.util = {};
YAHOO.lang.augmentObject( CPANEL.util, {
	
	// Catches the "enter" key when pressed in a text field.  Useful for simulating native <form> behavior.
	catch_enter : function(els, func) {
        
        // if func is a string, assume it's a submit button
        if (typeof(func) == "string") {
            var submit_button = func;
            var press_button = function() {
                YAHOO.util.Dom.get(submit_button).click();
            };
            func = press_button;
        }

        var _catch_enter = function(e, o) {
            var key = YAHOO.util.Event.getCharCode(e);
            if (key == 13) o.func.call(this,e);
        };

        YAHOO.util.Event.on(els, "keydown", _catch_enter, { func: func });
	},
	
	// initialize a second-decreasing countdown
	countdown_timeouts : [],
	countdown : function(el, after_func) {
		var seconds_el = YAHOO.util.Dom.get(el);
		if (! seconds_el) return;
		
		var second_decrease = function() {
			if (seconds_el) {
				var seconds = parseInt(seconds_el.innerHTML);
				if (seconds == 0) {
					after_func();
				}
				else {
					seconds_el.innerHTML = seconds - 1;
					CPANEL.util.countdown_timeouts[seconds_el.id] = setTimeout(second_decrease, 1000);
				}
			}
		};
		clearTimeout(this.countdown_timeouts[seconds_el.id]);
		this.countdown_timeouts[seconds_el.id] = setTimeout(second_decrease, 1000);
	},
	
	// add zebra stripes to a table, all arguments optional except el
	zebra : function(els, rowA, rowB, group_size) {
		if (! rowA) rowA = "rowA";
		if (! rowB) rowB = "rowB";
		if (! group_size) group_size = 1;
		
		// if els is not an array make it one
		if (YAHOO.lang.isArray(els) == false) {
			var el = els;
			els = [el];
		}
		
		// initialize the row and group
		var row = rowA;
		var group_count = 0;		
		
		for (var i=0; i < els.length; i++) {
			var table = YAHOO.util.Dom.get(els[i]);
			var rows = YAHOO.util.Dom.getElementsByClassName("zebra", "", table);
			
			for (var j=0; j < rows.length; j++) {
				// remove any existing row stripes
				YAHOO.util.Dom.removeClass(rows[j], rowA);
				YAHOO.util.Dom.removeClass(rows[j], rowB);
				
				// add the stripe class
				YAHOO.util.Dom.addClass(rows[j], row);
				group_count++;
				
				// alternate
				if (group_count == group_size) {
					group_count = 0;
					row = (row == rowA) ? rowB : rowA;
				}
			}
		}
	},
	
	convert_breaklines : function(str) {
		return str.replace(/\n/, "<br />");
	},
	
	// returns the value of the checked radio button
	// if no buttons are checked returns false
	get_radio_value : function(name, root) {
		if (! root) alert('Please provide a root element for the get_radio_value function to make it faster.');
		var inputs = YAHOO.util.Dom.getElementsBy(function(el) { return (YAHOO.util.Dom.getAttribute(el, "name") == name); }, "input", root);
		for (var i=0; i<inputs.length; i++) {
			if (inputs[i].checked) return inputs[i].value;
		}
		return false;		
	},
	
	toggle_more_less : function(toggle_el, text_el, state) {
		toggle_el = YAHOO.util.Dom.get(toggle_el);
		text_el = YAHOO.util.Dom.get(text_el);
		if (! toggle_el || ! text_el) {
			alert("You passed non-existent elements to the CPANEL.util.toggle_more_less function.");
			return;
		}
        if (!state) {
            if (  YAHOO.util.Dom.getStyle(text_el, "display") == "none" ) {
                state = "more";
            }
        }
		if (state == "more") {
            CPANEL.animate.slide_down( text_el, function() {
                toggle_el.innerHTML = CPANEL.lang.toggle_less;
				CPANEL.align_panels_event.fire();
            });
		}
		else {
            CPANEL.animate.slide_up( text_el, function() {
                toggle_el.innerHTML = CPANEL.lang.toggle_more;
				CPANEL.align_panels_event.fire();
            });
		}
	},

    keys : function (object) {
        var obj_keys = [];
        //no hasOwnProperty check here since we probably want prototype stuff
        for ( var key in object ) obj_keys.push( key );
        return obj_keys;
    },

    values : function (object) {
        var obj_values = [];
        //no hasOwnProperty check here since we probably want prototype stuff
        for ( var key in object ) obj_values.push( object[key] );
        return obj_values;
    },

	operating_system : function() {
		if (navigator.userAgent.search(/Win/) != -1) {
			return "Windows";
		}
		if (navigator.userAgent.search(/Mac/) != -1) {
			return "Mac";
		}	
		if (navigator.userAgent.search(/Linux/) != -1) {
			return "Linux";
		}
		return "Unknown";
	},
	
	toggle_unlimited : function(clicked_el, el_to_disable) {
		clicked_el = YAHOO.util.Dom.get(clicked_el);
		el_to_disable = YAHOO.util.Dom.get(el_to_disable);
		
		if (clicked_el.tagName.toLowerCase() != "input" || el_to_disable.tagName.toLowerCase() != "input") {
			alert("Error in CPANEL.util.toggle_unlimited() function:\nInput arguments are not of type <input />");
			return;
		}
		
		if (clicked_el.type.toLowerCase() == "text") {
			YAHOO.util.Dom.removeClass(clicked_el, "disabled_text_input");
			el_to_disable.checked = false;
		}
		else {
			clicked_el.checked = true;
			YAHOO.util.Dom.addClass(el_to_disable, "disabled_text_input");
		}
	},
	
	value_or_unlimited : function(text_input_el, radio_el, validation) {
		text_input_el = YAHOO.util.Dom.get(text_input_el);
		radio_el = YAHOO.util.Dom.get(radio_el);
		
		// add event handlers 
		YAHOO.util.Event.on(text_input_el, "focus", function() {
			radio_el.checked = false;
			YAHOO.util.Dom.removeClass(text_input_el, "cjt_disabled_input");
			validation.verify();
		});
		
		YAHOO.util.Event.on(radio_el, "click", function() {
			radio_el.checked = true;
			YAHOO.util.Dom.addClass(text_input_el, "cjt_disabled_input");
			validation.verify();
		});		
		// set initial state
		
	},
	
	// deep copy an object
	clone : function(obj) {
		var temp = YAHOO.lang.JSON.stringify(obj);
		return YAHOO.lang.JSON.parse(temp);
	},

    //prevent submitting the form when Enter is pressed on an <input> element
    prevent_submit : function(elem) {
        elem = YAHOO.util.Dom.get(elem);
        var stop_propagation = function(e) {
            var key_code = YAHOO.util.Event.getCharCode(e);
            if ( key_code == 13 ) YAHOO.util.Event.preventDefault(e);
        };

        YAHOO.util.Event.addListener( elem, 'keypress', stop_propagation );
        YAHOO.util.Event.addListener( elem, 'keydown',  stop_propagation );
    },

    get_text_content : function() {
        var lookup_property = CPANEL.has_text_content ? 'textContent' : 'innerText';
        this.get_text_content = function(el) {
            if ( typeof el === "string" ) {
                el = document.getElementById(el);
            }
            return el[lookup_property];
        };
        return this.get_text_content.apply(this,arguments);
    },

    set_text_content : function() {
        var lookup_property = CPANEL.has_text_content ? 'textContent' : 'innerText';
        this.set_text_content = function(el,value) {
            if ( typeof el === "string" ) {
                el = document.getElementById(el);
            }
            return( el[lookup_property] = value );
        };
        return this.set_text_content.apply(this,arguments);
    },
	
	get_numbers_from_string : function(str) {
		str = '' + str; // convert str to type String
		var numbers = str.replace(/\D/g,'');
		numbers = parseInt(numbers);
		return numbers;
	}

} ); // end util object
} // end else statement

//--- end /usr/local/cpanel/base/cjt//util.js ---

//--- start /usr/local/cpanel/base/cjt//validate.js ---
/*  
    #                                                 Copyright(c) 2010 cPanel, Inc.
    #                                                           All rights Reserved.
    # copyright@cpanel.net                                         http://cpanel.net
    # This code is subject to the cPanel license. Unauthorized copying is prohibited
*/ 

// check to be sure the CPANEL global object already exists
if (typeof CPANEL == "undefined" || !CPANEL) {
    alert('You must include the CPANEL global object before including validate.js!');
}
// check to be sure the YUI Animation module has been included
else if (typeof YAHOO.util.Anim == "undefined" || !YAHOO.util.Anim) {
    alert('You must include the YUI Animation library before including validate.js!');
}
else {
    
/**
    The validate module contains a validator class and methods used to validate user input.
    @module validate
*/

/**
    The validate class contains the validator class and methods used to validate user input.<br />
    YAHOO.util.Anim must be included before using this class.  An alert will show if it is not.
    @class validate
    @namespace CPANEL
    @extends CPANEL
*/
CPANEL.validate = {
    
    /**
        The validator class is used to provide validation to a group of &lt;input type="text" /&gt; fields.<br /><br />
        For example: You could use one validator object per fieldset and treat each fieldset group as one validation unit, 
        or you create a validator object for each &lt;input type="text" /&gt; element on the page.  The class is designed to be flexible 
        enough to work in any validation situation.<br /><br />
        HTML:<br />
        <pre class="brush: xml">
        &lt;form method="post" action="myform.cgi" /&gt;
        &nbsp;&nbsp;&nbsp;&nbsp;&lt;input type="text" id="user_name" name="user_name" /&gt;
        &nbsp;&nbsp;&nbsp;&nbsp;&lt;input type="text" id="user_email" name="user_email" /&gt;
        &nbsp;&nbsp;&nbsp;&nbsp;&lt;input type="submit" id="submit_user_info" value="Submit" /&gt;
        &lt;/form&gt;
        </pre>
        JavaScript:
        <pre class="brush: js">
        // create a new a validator object for my input fields
        var my_validator = new CPANEL.validate.validator("Contact Information Input");&#13;
        
        // add validators to the input fields
        my_validator.add("user_name", "min_length(%input%, 5)", "User name must be at least 5 characters long.");
        my_validator.add("user_name", "standard_characters", "User name must contain standard characters.  None of the following: &lt; &gt; [ ] { } \");
        my_validator.add("user_email", "email", "That is not a valid email address.");&#13;
        
        // attach the validator to the input fields (this adds automatic input validation when the user types in the field)
        my_validator.attach();&#13;
        
        // attach an event handler to the submit button in case they try to submit with invalid data
        YAHOO.util.Event.on("submit_info", "click", validate_form);&#13;
            
        // this function gets called when the submit button gets pressed
        function validate_form(event) {
        &nbsp;&nbsp;&nbsp;&nbsp;if (my_validator.is_valid() == false) {
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YAHOO.util.Event.preventDefault(event);     // prevent the form from being submitted
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CPANEL.validate.show_modal_error( my_validator.error_messages() );  // show a modal error dialog box
        &nbsp;&nbsp;&nbsp;&nbsp;}
        &nbsp;&nbsp;&nbsp;&nbsp;else {
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;// the "event" function gets called and the form gets submitted (in practice you don't need the "else" clause)
        &nbsp;&nbsp;&nbsp;&nbsp;}   
        };
        </pre>
        @class validator
        @namespace CPANEL.validate
        @constructor
        @param {string} title The title of the validator instance.  A human-readable title used to identify your validator against others that may be on the same page.
    */
    validator : function(title) {
        
        /**
            The title of the validator instance.  A human-readable title used to identify your validator against others that may be on the same page.
            @property title
            @type string
            @for CPANEL.validate.validator
        */
        if (typeof(title) != 'string') {
            alert('You need to pass the title of the validator object into the constructor.\nie: var my_validator = new CPANEL.validate.validator("Email Account");');
            return;
        }
        this.title = title;
        
        /**
            An array of validators.  Holds all the important information about your validator object.<br />
            This value is public, but in practice you will probably never need to access it.  I left it public for all those cases I couldn't think of where someone might need to access it directly.
            @property validators
        */
        this.validators = [];
        
        /**
            Adds an validator function to the validators array.<br />
            <br />
            example:<br />
            <pre class="brush: js">
            var my_validator = new CPANEL.validate.validator("My Validator");&#13;
            
            // add a function literal; here I'm assuming my_custom_function is defined elsewhere
            // remember that your custom function should return true or false
            my_validator.add("input_element", function() { my_custom_function(DOM.get("input_element").value) }, "My custom error message.");&#13;
            
            // if the second argument is a string it's assumed to be a method of CPANEL.validate, in this case CPANEL.validate.url
            my_validator.add("input_element", "url('httq://yahoo.com')", "That is not a valid URL.");&#13;
            
            // if the second argument has no parenthesis it's assumed to call the value of the input element
            // in this case CPANEL.validate.email( YAHOO.util.Dom.get("input_element").value )
            my_validator.add("input_element", "email", "That is not a valid email address.");&#13;
            
            // use %input% to refer to the element's value: YAHOO.util.Dom.get("input_element").value
            my_validator.add("input_element", "if_not_empty(%input%, CPANEL.validate.url)", "That is not a valid url.");
            my_validator.add("input_element", "min_length(%input%, 5)", "Input must be at least 5 characters long.");
            </pre>
            @method add
            @param {DOM element} el a DOM element or id, gets passed to YAHOO.util.Dom.get
            @param {string | function} func either a string or a function, WARNING: strings get eval'ed after some regex, see above for the syntax
            @param {string} msg the error message to be shown when func returns false; should be generated from &lt;cpanel langprint="error_message"&gt;
        */
        this.add = function(el, func, msg, conditional_func) {
            // verify that the element exists in the DOM
            el = YAHOO.util.Dom.get(el);
            if (! el) {
                alert("Error in CPANEL.validate.add: could not find element '" + el + "' in the DOM");
                return;
            }
            
            var error_element_id = el.id + "_error";
            var error_el = YAHOO.util.Dom.get(error_element_id);

            // if the id_error div/span does not exist, show an error
            if (! error_el) {
                alert("Error in CPANEL.validate.add: could not find element '" + error_element_id + "' in the DOM");
                return;
            }
            
            // make sure the error element is 16x16
            YAHOO.util.Dom.setStyle(error_el, "width", "16px");
            YAHOO.util.Dom.setStyle(error_el, "height", "16px");
            
            // if the error element is an image make it transparent
            if (error_el.tagName.toLowerCase() == "img") {
                error_el.src = CPANEL.icons.transparent_src;
                YAHOO.util.Dom.setStyle(error_el, "vertical-align", "middle");
            }
            
            // check that the error message is either a string or a function
            if (typeof(msg) != "string" && typeof(msg) != "function") {
                alert("Error in CPANEL.validate.add: msg must be either a string or a function");
                return;
            }
            
            // if they have not specified a conditional function, create one that evaluates to true (ie: their validator will always execute)
            if (! conditional_func) {
                conditional_func = function() { return true; }
            }
            // if the conditional function is a string assume it is a radio or checkbox
            // TODO: add support for <select><option> elements
            else if (typeof(conditional_func) == "string") {
                var conditional_el = YAHOO.util.Dom.get(conditional_func);
                if (! conditional_el) {
                    alert("Error in CPANEL.validate.add: could not find element '" + conditional_func + "' in the DOM.");
                    return;
                }

                var attribute_type = conditional_el.getAttribute("type");
                if (attribute_type == "radio" || attribute_type == "checkbox") {
                    conditional_func = function() { return conditional_el.checked; }
                }
                else {
                    alert("Error in CPANEL.validate.add: conditional function argument '" + conditional_el.id + "'must be a DOM element of type \"radio\" or \"checkbox\"");
                    return;
                }
            }

            // if func is a string convert it to a function
            if (typeof(func) == "string") {
                // if func is a string assume it's a method of CPANEL.validate
                // example syntax: validator_object.add("my_element", "url('http://yahoo.com')", "that is not a valid url");
                func = "CPANEL.validate." + func;
                
                // TODO: check that the string is a valid CPANEL.validate function
            
                // if the string does not contain any parenthesis assume it is a method that calls the input of the object passed into it
                // example syntax: validator_object.add("my_element", "url", "that is not a valid url");
                if (func.match(new RegExp(/[\(\)]/)) === null) {
                    func = func + "(%input%)";
                }
            
                // replace %input% with the element value
                // example syntax:  validator_object.add("my_element", "if_not_empty(%input%, CPANEL.validate.url)", "that is not a valid url");
                //                  validator_object.add("my_element", "min_length(%input%, 5)", "input must be at least 5 characters long");
                func = func.replace(/(\$input\$)|(%input%)/i, 'YAHOO.util.Dom.get("' + el.id + '").value');
                
                // convert func to a function literal
                // NOTE: use of eval() here; please modify this code with caution
                try {
                    eval('func = function() { return ' + func + '; };');
                }
                catch(e) {
                    alert("Error in CPANEL.validate.add: Error eval()ing your function argument");
                    return;
                }
            }
            
            // add the validator to the array
            this.validators.push( {el:el, func:func, msg:msg, conditional_func:conditional_func} );
        }

        /**
            Attaches the validator functions to their respective DOM elements (ie: adds an "onkeyup" event handler to the input fields).
            @method attach
        */      
        this.attach = function() {
            // get a list of all unique elements
            var elements = _get_unique_elements();
            
            // loop through the elements and add event handlers and error panels
            for (var i = 0; i < elements.length; i++) {
                // grab the validate functions and error messages for this element
                var element = elements[i];
                
                // add the event handler if necessary 
                // if type attribute is null get the tagName to test for textarea
                var attribute_type = element.type || element.tagName;

                // if password or text or textarea (case insensitive)
                if ( /password|text|textarea|file/i.test(attribute_type) ) {
                    YAHOO.util.Event.on(element, "keyup", verify_element, { el:element });
                    YAHOO.util.Event.on(element, "change", verify_element, { el:element });
                }
                
                // add the error panel
                create_error_panel(element);
            }
        };
        
        /**
            Removes all validators from their respective DOM elements (ie: removes the "keyup" and "change" event handlers).<br />
            WARNING: this will remove ALL event handlers for these elements; this is a limitation of YAHOO.util.Event
            @method detach
        */
        this.detach = function() {
            // get a list of all unique elements
            var elements = _get_unique_elements();
            
            // loop through the elements remove the event handlers
            for (var i=0; i<elements.length; i++) {
                YAHOO.util.Event.purgeElement(elements[i], false, "keyup");
                YAHOO.util.Event.purgeElement(elements[i], false, "change");
            }
            this.clear_messages();
        };

        /**
            Returns the current validation state for all the validators in the array.
            @method is_valid
            @return {boolean} returns true if all the validator functions return true
        */
        this.is_valid = function() {
            for (var i = 0; i < this.validators.length; i++) {
                if ( this.validators[i].el.disabled ) continue;
                if (this.validators[i].conditional_func() == true) {
                    if (this.validators[i].func() == false) {
                        return false;
                    }
                }
            }
            
            return true;
        };
        
        /**
            Returns an object of all the error messages for currently invalid input.<br />
            Useful for modal error boxes.
            @method error_messages
            @return {object} an object of error messages in the format: <code>&#123; title:"title", errors:["error message 1","error message 2"] &#125;</code><br />false if the the input is valid
        */
        this.error_messages = function() {
            // loop through the validators and get all the error messages
            var error_messages = [];
            for (var i = 0; i < this.validators.length; i++) {
                if (this.validators[i].conditional_func() == true) {
                    if (this.validators[i].func() == false) {
                        error_messages.push( _process_error_message(this.validators[i].msg, this.validators[i].el) );
                    }
                }
            }
            
            // no error messages, return false
            if (error_messages.length == 0) return false;
            
            return {
                title: this.title,
                errors: error_messages
            };
        };
        
        /** 
            Clears all validation status messages.
            @method clear_messages
        */
        this.clear_messages = function() {
            for (var i = 0; i < this.validators.length; i++) {
                var error_element = YAHOO.util.Dom.get(this.validators[i].el.id + "_error");
                if (error_element.tagName.toLowerCase() == "img") {
                    error_element.src = CPANEL.icons.transparent_src;
                }
                else {
                    error_element.innerHTML = "";
                }
            }
            hide_all_panels();
        };
        
        /**
            Shows validation success or errors on the page by updating the DOM.
            Useful when initially loading a page or for showing failure on a form submit button.
            @method verify
        */
        this.verify = function( target ) {
            // get a list of all unique elements
            var elements = _get_unique_elements();
            
            // loop through the elements and verify each one
            for (var i = 0; i < elements.length; i++) {
                verify_element(null, { el: elements[i] });
            }
        };
        
        /* 
            PRIVATE MEMBERS 
            Note: Yuidoc ignores private member documentation, but I included it in the same format for consistency.
        */
        
        /** 
            Use "that" if you need to reference "this" object.  See http://www.crockford.com/javascript/private.html for more information.
            @property that
            @private
        */
        var that = this;
        
        // private object to hold the error panels
        var panels = {};
        
        /**
            Creates an error YUI panel.
            @method create_error_panel
            @param {DOM element} The input element the error panel is for.
            @private
        */
        var create_error_panel = function(element) {
        
            // TODO: need to check to make sure we're not creating a new panel on top of one that already exists

            //This was originally written to use Panel, but Overlay is the better choice.
            //Unfortunate to put "Overlay" objects into the "panels" container,
            //and also for them to have a class of "validation_error_panel",
            //but it's the best way forward for now.
            var overlay_config = {
                visible : false, 
                zindex : 1000,
                context : [element.id + "_error", "tl", "tr", ["beforeShow", "windowResize", CPANEL.align_panels_event]]
            };
            DOM.addClass( element.id + "_error", "cjt_validation_error" );
            panels[element.id] = new YAHOO.widget.Overlay(element.id + "_error_panel", overlay_config );
            panels[element.id].setBody('');
            panels[element.id].render(document.body);

            // add the "validation_error_panel" style class to the overlay
            YAHOO.util.Dom.addClass(element.id + "_error_panel", "validation_error_panel");
        };
        
        /**
            Checks an element's input against a set of functions
            @method verify_element
            @param {object} o object handler
            @param {object} params object with the element to be checked, the functions to check it against, and the error messages to be displayed on failure
            @private
        */
        var verify_element = function(e, o) {
            if ( o.el.disabled ) return;

            // grab all the error messages from functions that are not valid
            var error_messages = [];
            for (var i = 0; i < that.validators.length; i++) {
                if (that.validators[i].el.id != o.el.id) continue;
                
                if (that.validators[i].conditional_func() == true) {
                    if (that.validators[i].func() == false) {
                        error_messages.push( that.validators[i].msg );
                    }
                }
            }
            
            // show success or error
            if (error_messages.length == 0) {
                show_success(o.el);
            }
            else {
                show_errors(o.el, error_messages);
            }
        };
        
        /**
            Show a successful input validation
            @method show_success
            @param {DOM element} element input element
            @private
        */
        var show_success = function(element) {
            var error_element = YAHOO.util.Dom.get(element.id + '_error');
            if (YAHOO.util.Dom.getStyle(error_element, "display") != "none") {
                // hide the panel if it is showing
                panels[element.id].hide();
    
                // show the success icon
                if (error_element.tagName.toLowerCase() == "img") {
                    error_element.src = CPANEL.icons.success_src;
                }
                else {
                    error_element.innerHTML = CPANEL.icons.success;
                }
                
                // purge the element of event handlers that pop up panels
                YAHOO.util.Event.purgeElement(error_element, false);
            }
        };
        
        // show input validation errors
        var show_errors = function(element, messages) {
            // get the error element
            var error_element = YAHOO.util.Dom.get(element.id + '_error');
            
            // if the error element is hidden do not show anything
            if (YAHOO.util.Dom.getStyle(error_element, "display") == "none") return;

            var no_panel = YAHOO.util.Dom.hasClass(error_element, "no_panel");
            var img_title;
            if (no_panel) {
                var dummy_span = document.createElement('span');
                img_title = [];
                for (var m=0; m<messages.length; m++) {
                    dummy_span.innerHTML = messages[m];
                    img_title.push(dummy_span.textContent || dummy_span.innerText);
                }
                img_title = img_title.join("\n");
            }
            
            // show the error image
            if (error_element.tagName.toLowerCase() == "img") {
                error_element.src = CPANEL.icons.error_src;
                if (no_panel) {
                    error_element.title = img_title;
                }
            }
            else {
                error_element.innerHTML = CPANEL.icons.error;
                if (no_panel) {
                    error_element.getElementsByTagName('img')[0].title = img_title;
                }
            }

            // do not show the panel if the "no_panel" class exists
            if (no_panel) return;

            // add the validation errors to the panel
            var panel_body = '<div class="validation_errors_div">';
            panel_body += '<ul class="validation_errors_ul">';
            for (var i = 0; i < messages.length; i++) {
                panel_body += '<li class="validation_errors_li">' + _process_error_message(messages[i], element) + '</li>';
            }
            panel_body += '</ul></div>';
            panels[element.id].setBody(panel_body);
            panels[element.id].show();

        };
        
        // hide all error panels
        var hide_all_panels = function() {
            for (var i in panels) {
                panels[i].hide();
            }
        };
        
        // returns an array of unique elements
        var _get_unique_elements = function() {
            var elements = [];
            for (var i = 0; i < that.validators.length; i++) {
                elements.push(that.validators[i].el);
            }
            return CPANEL.array.unique(elements);
        };
        
        // processes an error message
        var _process_error_message = function(msg, element) {
            // msg is a string
            if (typeof(msg) == "string") {
                return msg;
            }
            
            // msg is a function
            return msg(element);
        };
        
    },  // end validator object
    
    /**
        Shows a modal error box.<br />
        ProTip: Use the show_errors method of your validator object with this function.
        @method show_modal_error
        @for CPANEL.validate
        @param {object} messages an object of type: <code>&#123; title:"title", errors:["error message 1","error message 2"] &#125;</code> (can also be an array of this object type for when you have multiple validators on the same page)
    */
    show_modal_error : function(messages) {
        // convert messages to an array
        var temp = [];
        if (YAHOO.lang.isArray(messages) == false) {
            temp.push(messages);
            messages = temp;
        }
    
        // remove the panel if it already exists
        if (YAHOO.util.Dom.inDocument("validation_errors_modal_box") == true) {
            var remove_me = YAHOO.util.Dom.get("validation_errors_modal_box");
            remove_me.parentNode.removeChild(remove_me);
        }

        // create the panel
        var panel_options = {
                            width: "350px",
                            fixedcenter : true,
                            close : true,
                            draggable : false,
                            zindex : 1000,
                            modal : true,
                            visible : false
                            };
        var panel = new YAHOO.widget.Panel("validation_errors_modal_box", panel_options);
        
        // header
        var header = '<div class="lt"></div>';
        header += '<span>' + CPANEL.lang.Validation_Errors + '</span>';
        header += '<div class="rt"></div>';
        panel.setHeader(header);
        
        // body
        var body = '';
        for (var i = 0; i < messages.length; i++) {
            body += '<span class="validation_errors_modal_box_title">' + messages[i].title + '</span>';
            body += '<ul class="validation_errors_modal_box_ul">';
            var these_errors;
            if ( messages[i].errors instanceof Array ) {
                these_errors = messages[i].errors;
            }
            else {
                these_errors = [ messages[i].errors ];
            }
            for (var j = 0; j < these_errors.length; j++) {
                body += '<li class="validation_errors_modal_box_li">' + these_errors[j] + '</li>';
            }
            body += '</ul>';
        }
        body += '<center><input id="validation_errors_modal_panel_close_button" type="button" class="input-button" value="' + CPANEL.lang.Close + '" /></center><br />';
        panel.setBody(body);
        
        // add the event handler and put the focus on the close button after the panel renders
        var after_show = function() {
            YAHOO.util.Event.on("validation_errors_modal_panel_close_button", "click", function() { panel.hide(); });
            YAHOO.util.Dom.get("validation_errors_modal_panel_close_button").focus();
        }
        panel.showEvent.subscribe(after_show);
        
        // show the panel
        panel.render(document.body);
        panel.show();
    },
    
    /**
        Validates a form submission against validator objects.  
        If the validator object(s) validate to true the form gets submitted, else the form submission is halted and a modal error box with the validation errors is shown.
        This method attaches an "onclick" event handler to the form submission element.
        @method attach_to_form
        @param {DOM element} el the id of the form submit button
        @param {object} validators a single validator object, an array of validator objects, or an object of validator objects
        // optional: callback_func gets executed upon successful validation
    */
    attach_to_form : function(el, validators, callback_func) {

        var typeof_validator = function(obj) {
            if (typeof(obj.add) != "function") return false;
            if (typeof(obj.attach) != "function") return false;
            if (typeof(obj.title) != "string") return false;
            return true;
        };

        // convert a single instance, array, or object of validators to an array
        var temp = [];
        if (typeof_validator(validators) == true) {
            temp.push(validators);
        }
        else {
            for (var i in validators) {
                if (typeof_validator(validators[i]) == false) continue;
                temp.push( validators[i] );
            }
        }
        validators = temp;

        // check to see if the validator functions are valid
        var check_form = function(event) {
            var messages = [];
            var good_data = true;

            // loop through the validators
            for (var i = 0; i < validators.length; i++) {
                validators[i].verify();
                if (validators[i].is_valid() == false) {
                    good_data = false;
                    messages.push( validators[i].error_messages() );
                }
            }
            
            // if the validators are not true, stop the default event and show the modal error panel
            // also the optional callback function does not get called
            if (good_data == false) {
                EVENT.preventDefault(event);
                CPANEL.validate.show_modal_error(messages);
                return;
            }
            // else the form submission event gets called inherently
            
            if (typeof(callback_func) !== 'undefined') {
                callback_func();
            }
        };
        
        YAHOO.util.Event.on(el, "click", check_form);
    },
    
    // create a validator object from a validation definition
    create : function(id, name, definition) {
        // check the id
        var el = YAHOO.util.Dom.get(id);
        if (! el) {
            alert("Error in CPANEL.validate.create: id '" + el.id + "' does not exist in the DOM.");
            return;
        }
        
        // check the definition
        if (! CPANEL.validation_definitions[definition]) {
            alert("Error in CPANEL.validate.create: Validation definition '" + definition + "' does not exist.");
            return;
        }

        var atoms = CPANEL.validate.util.get_atoms_from_definition(definition);
        var func = CPANEL.validate.util.create_function_from_atoms(atoms, el);
        var msg = CPANEL.validate.util.create_msg_from_atoms(atoms);
        
        var validator = new CPANEL.validate.validator(name);
        validator.add(id, func, msg);
        validator.attach();
        return validator;
    },

    /**
        Validates the local part of an email address: <u>local</u>@domain.tld<br />
        see: <a href="http://en.wikipedia.org/wiki/E-mail_address#RFC_specification">RFC spec</a>.
        @method local_part_email
        @param {string} str The local part of an email address.
        @param {spec} str (optional) either "cpanel" or "rfc", defaults to rfc
        @return {boolean} returns true if <code>str</code> fits the RFC spec
    */
    local_part_email : function(str, spec) {
        if (! spec) spec = "rfc";
        if (spec != "cpanel" && spec != "rfc") alert("CPANEL.validate.local_part_email: invalid spec argument!");
        
        // string cannot be empty
        if (str === '') return false;
        
        // string must contain only these characters
        var pattern;
        if (spec == "rfc") {
            pattern = new RegExp("[^\.a-zA-Z0-9!#$%&'*+/=?^_`{|}~-]");
        }
        else {
            pattern = new RegExp("[^\.a-zA-Z0-9!#$=?^_{}~-]");
        }
        if (pattern.test(str) == true) {
            return false;
        }
        
        // if the string has '.' as the first or last characer then it's not valid
        if (str.charAt(0) == '.' || str.charAt(str.length-1) == '.') {
            return false;
        }
        
        // if the string contains '..' then it's not valid
        pattern = new RegExp(/\.\./);
        if (pattern.test(str) == true) {
            return false;
        }
        
        return true;
    },
    
    /**
        This function validates a hostname: http://<u>cpanel.net</u>
        @method host
        @param {string} str A hostname.
        @return {boolean} returns true if <code>str</code> is a valid hostname
    */
    host : function(str) {
        var chunks = str.split(".");
        if (chunks.length < 2) return false;
        
        for (var i = 0; i < chunks.length-1; i++) {
            if (CPANEL.validate.domain(chunks[i]) == false) return false;
        }
        
        // last chunk must be a tld
        if (CPANEL.validate.tld("." + chunks[chunks.length-1]) == false) return false;
        
        return true;
    },

    /**
        This function validates an email address to RFC spec: <u>local@domain.tld</u>
        @method email
        @param {string} str An email address.
        @return {boolean} returns true if <code>str</code> is a valid email address
    */
    email : function(str) {
        // split on the @ symbol
        var groups = str.split('@');
        
        // must be split into two at this point
        if (groups.length != 2) return false;
        
        // validate the local part
        if (CPANEL.validate.local_part_email(groups[0]) == false) return false;
        
        // validate the rest
        return CPANEL.validate.fqdn(groups[1]);
    },
    
    /**
        This function validates an email address to cPanel spec: <u>local@domain.tld</u>
        @method cpanel_email
        @param {string} str An email address.
        @return {boolean} returns true if <code>str</code> is a valid cpanel email address
    */
    cpanel_email : function(str) {
        // split on the @ symbol
        var groups = str.split('@');
        
        // must be split into two at this point
        if (groups.length != 2) return false;
        
        // validate the local part
        if (CPANEL.validate.local_part_email(groups[0], "cpanel") == false) return false;
        
        // validate the rest
        return CPANEL.validate.fqdn(groups[1]);
    },
    
    /**
        This function validates a URL: <u>http://cpanel.net</u><br />
        The URL must include <code>http://</code> or <code>https://</code> at the beginning.
        @method url
        @param {string} str a URL
        @return {boolean} returns true if <code>str</code> is a valid URL
    */
    url : function(str) {
        // must contain 'http://' or 'https://' at the start
        if (str.substring(0,7) != 'http://' && str.substring(0,8) != 'https://') {
            return false;
        }
        
        // grab the domain and tlds
        var front_slashes = str.search(/:\/\//);
        if (front_slashes == -1) return false;
        str = str.substring(front_slashes + 3);
        
        // see if there is something after the last tld (path)
        var back_slash = str.search(/\//);
        if (back_slash == -1) back_slash = str.length;
        var domain_and_tld = str.substring(0, back_slash);
        
        return CPANEL.validate.fqdn(domain_and_tld);
    },
    
    fqdn : function(str) {
        // check the domain and tlds
        var groups = str.split('.');
        
        // must have at least one domain and tld
        if (groups.length < 2) return false;
        
        // check each group
        for (var i=0; i<groups.length; i++) {
            // the first entry must be a domain
            if (i == 0) {
                if (CPANEL.validate.domain(groups[i]) == false) return false;
            }
            // the last entry must be a tld
            if (i == groups.length-1) {
                if (CPANEL.validate.tld('.' + groups[i]) == false) return false;
            }
            
            // everything else in between must be either a domain or a tld
            if (CPANEL.validate.tld('.' + groups[i]) == false && CPANEL.validate.domain(groups[i]) == false) return false;
        }
        
        return true;
    },

    /**
        Validates a top level domain (TLD): .com, .net, .org, .co.uk, etc<br />
        This function does not check against a list of TLDs.  Instead it makes sure that the TLD is formatted correctly.<br />
        TLD must begin with a period (.)
        @method tld
        @param {string} str a TLD
        @return {boolean} returns true if <code>str</code> is a valid TLD
    */
    tld : function(str) {
        // string must contain only these characters
        var pattern = new RegExp("[^a-zA-Z0-9-\.]");
        if (pattern.test(str) == true) {
            return false;
        }
        
        // string must have '.' as a first character and not '.' as a last character
        if (str.charAt(0) != '.' || str.charAt(str.length-1) == '.') {
            return false;
        }
        
        // string cannot contain '..'
        pattern = new RegExp(/\.\./);
        if (pattern.test(str) == true) {
            return false;
        }
        
        return true;
    },

    /**
        Validates a domain name: http://<u>cpanel</u>.net
        @method domain
        @param {string} str a domain
        @return {boolean} returns true if <code>str</code> is a valid domain
    */
    domain : function(str) {
        // string must contain only these characters
        var pattern = new RegExp("[^_a-zA-Z0-9-]");
        if (pattern.test(str) == true) return false;

        // We're allowing underscores but only as the first character
        if ( /_/.test( str.substr(1) ) ) {
           return false;
        }
        
        // string cannot have '-' as a first or last character
        if (str.charAt(0) == '-' || str.charAt(str.length-1) == '-') return false;
        
        // domain name cannot be longer than 63 characters
        if (str.length == 0 || str.length > 63) return false;
        
        return true;
    },
    
    /**
        Validates a subdomain: http://<u>foo</u>.cpanel.net
        @method subdomain
        @param {string} str a subdomain
        @return {boolean} returns true if <code>str</code> is a valid subdomain
    */
    subdomain : function(str) {       
        // string must contain only these characters
        var pattern = new RegExp("[^_a-zA-Z0-9-\.]");
        if (pattern.test(str) == true) return false;

        // We're allowing underscores but only as the first character
        if ( /_/.test( str.substr(1) ) ) {
           return false;
        }
      
        // last character must be alphanumeric
        if (CPANEL.validate.alphanumeric(str.charAt(str.length-1)) == false) return false;
        
        // subdomain cannot be longer than 63 characters
        if (str.length == 0 || str.length > 63) return false;
        
        // string cannot contain '..'
        pattern = new RegExp(/\.\./);
        if (pattern.test(str) == true) {
            return false;
        }
        
        return true;
    },
    
    /**
        Validates alpha characters: a-z A-Z
        @method alpha
        @param {string} str some characters
        @return {boolean} returns true if <code>str</code> contains only alpha characters
    */
    alpha : function(str) {
        // string cannot be empty
        if (str == '') return false;
        
        // string must contain only these characters
        var pattern = new RegExp("[^a-zA-Z]");
        if (pattern.test(str) == true) return false;
        return true;
    },
    
    /**
        Validates alphanumeric characters: a-z A-Z 0-9
        @method alphanumeric
        @param {string} str some characters
        @return {boolean} returns true if <code>str</code> contains only alphanumeric characters
    */
    alphanumeric : function(str) {
        // string cannot be empty
        if (str == '') return false;

        // string must contain only these characters
        var pattern = new RegExp("[^a-zA-Z0-9]");
        if (pattern.test(str) == true) return false;
        return true;
    },      
    
    /**
        Validates alphanumeric characters: a-z A-Z 0-9, underscore (_) and hyphen (-)
        @method sql_alphanumeric
        @param {string} str some characters
        @return {boolean} returns true if <code>str</code> contains only alphanumeric characters and or underscore
    */
    sql_alphanumeric : function(str) {
        // string cannot be empty
        if (str == '') return false;
        
        // string cannot contain a trailing underscore
        if ( /_$/.test(str) ) return false;

        // string must contain only these characters
        var pattern = new RegExp("[^a-zA-Z0-9_\-]");
        if (pattern.test(str) == true) return false;
        return true;
    },      

    /**
        Validates that a string is a minimum length.
        @method min_length
        @param {string} str the string to check
        @param {integer} length the minimum length of the string
        @return {boolean} returns true if <code>str</code> is longer than or equal to <code>length</code>
    */
    min_length : function(str, length) {
        if (str.length >= length) {
            return true;
        }
        return false;
    },

    /**
        Validates that a string is not longer than a maximum length.
        @method max_length
        @param {string} str the string to check
        @param {integer} length the maximum length of the string
        @return {boolean} returns true if <code>str</code> is shorter than or equal to <code>length</code>
    */
    max_length : function(str, length) {
        if (str.length <= length) {
            return true;
        }
        return false;
    },

    /**
        Validates that two fields have the same value (useful for password input).
        @method equals
        @param {DOM element} el1 The first element.  Should be of type "text"
        @param {DOM element} el2 The second element.  Should be of type "text"
        @return {boolean} returns true if el1.value equals el2.value
    */
    equals : function(el1, el2) {
        el1 = YAHOO.util.Dom.get(el1);
        el2 = YAHOO.util.Dom.get(el2);
        if (el1.value == el2.value) return true;
        return false;
    },
    
    /**
        Validates anything.<br />
        Useful when you want to accept any input from the user, but still give them the same visual feedback they get from input fields that actually get validated.
        @method anything
        @return {boolean} returns true
    */
    anything : function() {
        return true;
    },

    /**
        Validates a field only if it has a value.
        @method if_not_empty
        @param {string | DOM element} value If a DOM element is passed in it should be an input of type="text".  It's value will be grabbed with YAHOO.util.Dom.get(<code>value</code>).value
        @param {function} func The function to check the value against.
        @return {boolean} returns the value of <code>func(value)</code> or true if <code>value</code> is empty
    */
    if_not_empty : function(value, func) {
        // if value is not a string, assume it's an element and grab it's value
        if (typeof(value) != 'string') value = YAHOO.util.Dom.get(value).value;
        
        if (value != '') return func(value);
        else return true;
    },
    
    /**
        Validates that a field contains a positive integer.
        @method positive_integer
        @param {string} value the value to check
        @returns {boolean} returns true if the string is a positive integer
    */
    positive_integer : function(value) {
        // convert value to a string
        value = value + "";
        
        if (value === '') return false;
        var pattern = new RegExp("[^0-9]");
        if (pattern.test(value) == true) return false;
        return true;
    },
    
    /**
        Validates that a field contains a negative integer.
        @method negative_integer
        @param {string} value the value to check
        @returns {boolean} returns true if the string is a negative integer
    */
    negative_integer : function(value) {
        // convert value to a string
        value = value + "";
        
        // first character must a minus sign
        if (value.charAt(0) !== '-') return false;
        
        // get the rest of the string
        value = value.substr(1);
        
        var pattern = new RegExp("[^0-9]");
        if (pattern.test(value) == true) return false;
        return true;
    },  

    /**
        Validates that a field contains a integer.
        @method integer
        @param {string} value the value to check
        @returns {boolean} returns true if the string is an integer
    */
    integer : function(value) {
        if (CPANEL.validate.negative_integer(value) == true || CPANEL.validate.positive_integer(value) == true) return true;
        return false;
    },  
    
    
    /**
        Validates that a field contains an integer less than a <code>value</code>
        @method max_value
        @param {integer} value the value to check
        @param {integer} max the maximum value
        @returns {boolean} returns true if <code>value</code> is an integer less than <code>max</code>
    */
    max_value : function(value, max) {
        if (CPANEL.validate.integer(value) == false) return false;
        // convert types to integers for the test
        value = parseInt(value, 10);
        max = parseInt(max, 10);
        
        if (value > max) return false;
        return true;
    },
    
    /**
        Validates that a field contains an integer greater than a <code>value</code>
        @method min_value
        @param {integer} value the value to check
        @param {integer} min the minimum value
        @returns {boolean} returns true if <code>value</code> is an integer greater than <code>max</code>
    */
    min_value : function(value, min) {
        if (CPANEL.validate.integer(value) == false) return false;
        value = parseInt(value, 10);
        min = parseInt(min, 10);
        
        if (value < min) return false;
        return true;
    },
    
    less_than : function(value, less_than) {
        if (CPANEL.validate.integer(value) == false) return false;
        value = parseInt(value, 10);
        less_than = parseInt(less_than, 10);
        
        if (value < less_than) return true;
        return false;
    },
    
    greater_than : function(value, greater_than) {
        if (CPANEL.validate.integer(value) == false) return false;
        value = parseInt(value, 10);
        greater_than = parseInt(greater_than, 10);
        
        if (value > greater_than) return true;
        return false;
    },  
    
    /**
        Validates that a field does not contain a set of characters.
        @method no_chars
        @param {string} str The string to check against.
        @param {char | Array} chars Either a single character or an array of characters to check against.
        @return {boolean} returns true if none of the characters in <code>chars</code> exist in <code>str</code>.
    */
    no_chars : function(str, chars) {
        // convert chars into an array if it is not
        if (typeof(chars) === 'string') {
            var chars2 = chars.split("");
            chars = chars2;
        }
    
        for (var i=0; i<chars.length; i++) {
            if (str.indexOf(chars[i]) != -1) {
                return false;
            }
        }
    
        return true;
    },
    
    not_string : function(str, notstr) {
        if (str == notstr) return false;
        return true;
    },
    
    // directory paths cannot be empty or contain the following characters: \ ? % * : | " < >
    dir_path : function(str) {
        if (str == '') return false;
        
        // string cannot contain these characters: \ ? % * : | " < >
        var chars = "\\?%*:|\"<>";
        return CPANEL.validate.no_chars(str, chars);
    },
    
    // quotas must be either a number or "unlimited"
    quota : function(str) {
        if (CPANEL.validate.positive_integer(str) == false && str != CPANEL.lang.unlimited) return false;
        return true;
    },
    
    // MIME type
    mime : function(str) {
        // cannot have spaces
        if (CPANEL.validate.no_chars(str, " ") == false) return false;
        
        // forward slash /
        var slash1 = str.indexOf('/');
        var slash2 = str.lastIndexOf('/');
        if (slash1 == -1 || slash1 != slash2) return false; // must contain only one forward slash
        if (slash1 == 0 || slash1 == (str.length-1)) return false;  // forward slash cannot be first or last character
        
        return true;
    },
    
    // MIME extension
    mime_extension : function(str) {
        // must be a minimum of one alpha-numeric character
        var pattern = new RegExp(/\w/g);
        if (pattern.test(str) == false) return false;
        
        // cannot contain special filename characters
        return CPANEL.validate.no_chars(str, "/&?\\");
    },
    
    apache_handler : function(str) {
        // cannot have spaces
        if (CPANEL.validate.no_chars(str, " ") == false) return false;
        
        // forward slash /
        var hyphen1 = str.indexOf('-');
        var hyphen2 = str.lastIndexOf('-');
        if (hyphen1 == -1) return false;    // must contain at least one hyphen
        if (hyphen1 == 0 || hyphen2 == (str.length-1)) return false;    // hyphen cannot be first or last character
        
        return true;
    },
    
    // validates an IP address
    ip : function(str) {
        var chunks = str.split(".");
        if (chunks.length != 4) return false;
        
        for (var i=0; i<chunks.length; i++) {
            if (CPANEL.validate.positive_integer(chunks[i]) == false) return false;
            if (chunks[i] > 255) return false;
        }
        
        return true;
    },
    
    // returns false if they enter a local IP address, 127.0.0.1, 0.0.0.0
    no_local_ips : function(str) {
        return !(str == "127.0.0.1" || str == "0.0.0.0");
    },
    
    // validates a filename
    filename : function(str) {
        if (str.indexOf("/") != -1) return false;   // cannot be a directory path (forward slash)
        if (CPANEL.validate.dir_path(str) == false) return false;
        return true;
    },
    
    // str==source, allowed is an array of possible endings (returns true on match), case insensitive
    end_of_string : function (str, allowed) {
    
        // convert "allowed" to an array if it's not otherwise so
        if ( ! YAHOO.lang.isArray( allowed ) ) allowed = [allowed];

        // Compare each element of allowed against str
        for (var i=0; (i < allowed.length ); i++) {
           if ( str.substr(str.length - allowed[i].length).toLowerCase() == allowed[i].toLowerCase() ) return true;
        }
        return false;       
    },
    
    // must end and begin with an alphanumeric character, many logins require this
    alphanumeric_bookends : function(str) {
        if (str == '') return true;
        if (CPANEL.validate.alphanumeric(str.charAt(0)) == false) return false;
        if (CPANEL.validate.alphanumeric(str.charAt(str.length-1)) == false) return false;
        return true;
    },
    
    zone_name : function(str) {
        if (str == "") return false;
        
        // cut off the trailing period if it's there
        if (str.charAt(str.length-1) == ".") str = str.substr(0, str.length-1);
        
        var chunks = str.split(".");
        if (chunks.length < 1) return false;
        
        for (var i=0; i<chunks.length; i++) {
            if ((CPANEL.validate.domain(chunks[i]) == false)&&(chunks[i]!='*')) return false;
        }
    
        return true;
    },
    
    ftp_username : function(str) {
        // username cannot be empty
        if (str == "") return false;
        
        // username cannot be "FTP"
        if (str.toLowerCase() == 'ftp') return false;
        
        // username cannot be longer than 25 characters
        if (str.length > 25) return false;
        
        // username must only contain these characters
        var pattern = new RegExp("[^0-9a-zA-Z_\-]");
        if (pattern.test(str) == true) return false;
        
        return true;
    },

    // Verify the case-insensitive value is not present in str
    not_present : function (str, value) {
        // Convert everything to lower case for case insensitivity.
        var lower_str = str.toLowerCase();
        var lower_value = value.toLowerCase();
        if (lower_str.indexOf(lower_value) >= 0) {
            return false;
        }
        return true;
    },
    
    // Verify the case-insensitive value is present in str
    present : function (str, value) {
        // Convert everything to lower case for case insensitivity.
        var lower_str = str.toLowerCase();
        var lower_value = value.toLowerCase();
        if (lower_str.indexOf(lower_value) >= 0) {
            return true;
        }
        return false;
    },
    
    // returns true only if all the characters in str exist in whitelist
    // whitelist is a string
    whitelist : function(str, whitelist) {
        var str_length = str.length;
        var whitelist_length = whitelist.length;
        for (var i = 0 ; i < str_length; i++) {
            var char_good = false;
            for (var j = 0; j < whitelist_length; j++) {
                if (str.charAt(i) == whitelist.charAt(j)) {
                    char_good = true;
                    break;
                }
            }
            if (char_good == false) return false;
        }
        return true;
    },
    
    // returns true only if all the characters in str do not exist in blacklist
    // blacklist is a string
    blacklist : function(str, blacklist) {
        var str_length = str.length;
        var blacklist_length = blacklist.length;
        for (var i = 0 ; i < str_length; i++) {
            for (var j = 0; j < blacklist_length; j++) {
                if (str.charAt(i) == blacklist.charAt(j)) return false;
            }
        }
        return true;        
    },
    
    // holds utility functions used to deal with validation definitions
    util : {
        // returns an array of all the atoms for a definition
        get_atoms_from_definition : function(definition) {
            var atoms = CPANEL.validation_definitions[definition];
            
            // continue looping through the array until all the definition strings have been expanded
            // note: this could also be accomplished with a recursive function
            var all_definitions_expanded = false;
            while (all_definitions_expanded == false) {
                all_definitions_expanded = true;
                var atoms2 = [];
                for (var i = 0; i < atoms.length; i++) {
                    if (typeof(atoms[i]) == "string") {
                        all_definitions_expanded = false;
                        var more_atoms = CPANEL.validation_definitions[ atoms[i] ];
                        for (var j = 0; j < more_atoms.length; j++) {
                            atoms2.push( more_atoms[j] );
                        }
                    }
                    else {
                        atoms2.push( atoms[i] );
                    }
                }
                
                atoms = atoms2;
            };
            
            atoms = CPANEL.validate.util.scrub_atom_types(atoms);
            
            return atoms;
        },
        
        // prep atoms
        scrub_atom_types : function(atoms) {
            for (var i = 0; i < atoms.length; i++) {
                var atom = atoms[i];
                
                // convert to string and expand character ranges
                if (atom.valid_chars) {
                    atom.valid_chars = atom.valid_chars + "";
                    atom.valid_chars = CPANEL.validate.util.expand_char_ranges(atom.valid_chars);
                }
                else if (atom.invalid_chars) {
                    atom.invalid_chars = atom.invalid_chars + "";
                    atom.invalid_chars = CPANEL.validate.util.expand_char_ranges(atom.invalid_chars);
                }
                
                // convert to RegExp
                else if (atom.valid_regexp) {
                    try {
                        eval("var pattern = " + atom.valid_regexp + ";");
                    }
                    catch(e) {
                        alert("Error in CPANEL.validate.util.scrub_atom_types: Eval failed. Check your RegExp syntax '" + atom.valid_regexp + "'");
                        return;
                    }
                    atom.valid_regexp = pattern;
                }
                else if (atom.invalid_regexp) {
                    try {
                        eval("var pattern = " + atom.invalid_regexp + ";");
                    }
                    catch(e) {
                        alert("Error in CPANEL.validate.util.scrub_atom_types: Eval failed. Check your RegExp syntax '" + atom.invalid_regexp + "'");
                        return;
                    }
                    atom.invalid_regexp = pattern;
                }
                
                // convert to integers
                else if (atom.max_length) {
                    atom.max_length = parseInt(atom.max_length, 10);
                }
                else if (atom.min_length) {
                    atom.min_length = parseInt(atom.min_length, 10);
                }
                else if (atom.less_than) {
                    atom.less_than = parseInt(atom.less_than, 10);
                }
                else if (atom.greater_than) {
                    atom.greater_than = parseInt(atom.greater_than, 10);
                }
            }
            return atoms;
        },
        
        // expand character ranges for valid_chars, invalid_chars definitions
        expand_char_ranges : function(str) {
            str = str.replace(/a-z/, "abcdefghijklmnopqrstuvwxyz");
            str = str.replace(/A-Z/, "ABCDEFGHIJKLMNOPQRSTUVWXYZ");
            str = str.replace(/0-9/, "0123456789");
            return str;         
        },
        
        // returns a boolean function from an atom
        create_function_from_atom : function(atom, el) {
            var func;
            if (typeof(atom.valid_chars) != "undefined") {
                func = function() {
                    return CPANEL.validate.whitelist(el.value, atom.valid_chars);
                };
            }
            else if (typeof(atom.invalid_chars) != "undefined") {
                func = function() {
                    return CPANEL.validate.blacklist(el.value, atom.invalid_chars);
                };
            }
            else if (typeof(atom.valid_regexp) != "undefined") {
                func = function() {
                    if (el.value.search(atom.valid_regexp) == -1) return false;
                    return true;
                };
            }
            else if (typeof(atom.invalid_regexp) != "undefined") {
                func = function() {
                    if (el.value.search(atom.invalid_regexp) == -1) return true;
                    return false;
                };
            }
            else if (typeof(atom.max_length) != "undefined") {
                func = function() {
                    return CPANEL.validate.max_length(el.value, atom.max_length);
                };
            }
            else if (typeof(atom.min_length) != "undefined") {
                func = function() {
                    return CPANEL.validate.min_length(el.value, atom.min_length);
                };
            }
            else if (typeof(atom.less_than) != "undefined") {
                func = function() {
                    return CPANEL.validate.less_than(el.value, atom.less_than);
                };
            }
            else if (typeof(atom.greater_than) != "undefined") {
                func = function() {
                    return CPANEL.validate.greater_than(el.value, atom.greater_than);
                };
            }
            
            return func;
        },
        
        get_msg_from_atom : function(atom, str) {
            var msg = atom.msg;
            
            // valid_chars, invalid_chars
            if (typeof(atom.valid_chars) != "undefined" || typeof(atom.invalid_chars) != "undefined") {
                msg = msg.replace("%invalid_chars%", CPANEL.validate.util.get_invalid_chars_for_atom(atom, str));
            }
            
            // valid, invalid
            if (typeof(atom.invalid) != "undefined") {
                msg = msg.replace("%invalid%", CPANEL.validate.util.get_invalid_for_atom(atom, str));
            }
        
            return msg;
        },
        
        create_msg_from_atoms : function(atoms) {
            var msg = function(el) {
                for (var i = 0; i < atoms.length; i++) {
                    var func = CPANEL.validate.util.create_function_from_atom(atoms[i], el);
                    if (func() == true) continue;
        
                    return CPANEL.validate.util.get_msg_from_atom(atoms[i], el.value);
                }
            };
            
            return msg;
        },
        
        // general function to return an array of illegal characters not in the whitelist
        return_illegal_whitelist_chars : function(str, whitelist) {
            var illegal_chars = [];
            var str_length = str.length;
            var whitelist_length = whitelist.length;
            for (var i = 0 ; i < str_length; i++) {
                var char_good = false;
                for (var j = 0; j < whitelist_length; j++) {
                    if (str.charAt(i) == whitelist.charAt(j)) {
                        char_good = true;
                        break;
                    }
                }
                if (char_good == false) {
                    illegal_chars.push( str.charAt(i) );
                }
            }
            
            // remove any duplicate characters
            illegal_chars = CPANEL.array.unique(illegal_chars);
            
            return illegal_chars;
        },
        
        // returns a space-separated string of invalid characters from an input
        get_invalid_chars_for_atom : function(atom, str) {
            var invalid_chars_arr = [];
            
            // if invalid_chars is already defined, return it
            if (typeof(atom.invalid_chars) != "undefined") {
                invalid_chars_arr = atom.invalid_chars.split("");
            }
            // else calculate the invalid chars
            else {
                invalid_chars_arr = CPANEL.validate.util.return_illegal_whitelist_chars(str, atom.valid_chars);
            }
            
            return invalid_chars_arr.join(" ");
        },
        
        // get invalid match string from an input
        get_invalid_for_atom : function(atom, str) {
            var invalid_msg = str.match(atom.invalid_regexp);
            return invalid_msg.join(" ");
        },
        
        // returns a single boolean function from an array of atoms
        create_function_from_atoms : function(atoms, el) {
            // loop through the validation atoms and create functions for each one
            var funcs = [];
            for (var i = 0; i < atoms.length; i++) {
                funcs.push( CPANEL.validate.util.create_function_from_atom(atoms[i], el) );
            }
            
            // create the single boolean validation function
            var func = function() {
                for (var i = 0; i < funcs.length; i++) {
                    if (funcs[i]() == false) {
                        return false;
                    }
                }
                return true;
            };
            
            return func;
        }
    }
    
} // end validate object
} // end else statement

//--- end /usr/local/cpanel/base/cjt//validate.js ---

//--- start /usr/local/cpanel/base/cjt//validation_definitions.js ---
/*  
    #                                                 Copyright(c) 2010 cPanel, Inc.
    #                                                           All rights Reserved.
    # copyright@cpanel.net                                         http://cpanel.net
    # This code is subject to the cPanel license. Unauthorized copying is prohibited
*/ 

/*
Validation Atoms (the lowest level of validation structure)
> contains a boolean function in one of the following formats: valid_chars, invalid_chars, valid, invalid, min_length, max_length, less_than, greater_than
> each method is accompanied with a message (msg)
> messages can have some limited variable interpolation

valid_chars, invalid_chars
> character string
> can contain three optional ranges: a-z, A-Z, 0-9
> msg has 1 variable available to it: %invalid_chars%

valid_regexp
> regular expression
> should be very basic and easy to read
> must work in both Perl and JavaScript
> if the input string finds a match against the regular expression the function returns true
> if the regular expression finds a match against the input string --> return true
> if the regular expression does not find a match against the input string --> return false

invalid_regexp
> regular expression
> should be very basic and easy to read
> must work in both Perl and JavaScript
> msg has 1 variable available to it: %invalid%
> if the input string finds a match against the regular expression the function returns false

max_length, min_length
> integer
> compares against the length of the string
> msg has no variables available

less_than, greater_than
> integer
> treats the string as an number, returns false if the string is not a number
> msg has no variables available
*/

CPANEL.validation_definitions = {
	"IPV4_ADDRESS" : [
		{
			"min_length" : "1",
			"msg" : "IP Address cannot be empty."
		},
		{
			"valid_chars" : ".0-9",
			"msg" : "IP Address must contain only digits and periods."
		},
		{
			"valid_regexp" : "/^([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])\\.([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])\\.([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])\\.([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])$/",
			"msg" : "IP Address not formatted correctly.  ie: 4.2.2.2, 192.168.1.100"
		}
	],
	
	"IPV4_ADDRESS_NO_LOCAL_IPS" : [
		"IPV4_ADDRESS",
		{
			"invalid_regexp" : "/(127\\.0\\.0\\.1)|(0\\.0\\.0\\.0)/",
			"msg" : "IP Address cannot be local.  ie: 127.0.0.1, 0.0.0.0"
		}
	],
	
	"LOCAL_EMAIL" : [
		{
			"min_length" : "1",
			"msg" : "Email cannot be empty."
		},
		{
			"max_length" : "128",
			"msg" : "Email cannot be longer than 128 characters."
		},
		{
			"invalid_chars" : " ",
			"msg" : "Email cannot contain spaces."
		},
		{
			"invalid_regexp" : "/\\.\\./",
			"msg" : "Email cannot contain two consecutive periods."
		},
		{
			"invalid_regexp" : "/^\\./",
			"msg" : "Email cannot start with a period."
		},
		{
			"invalid_regexp" : "/\\.$/",
			"msg" : "Email cannot end with a period. %invalid%"
		}
	],
	
	"LOCAL_EMAIL_CPANEL" : [
		"LOCAL_EMAIL",
		{
			"valid_chars" : ".a-zA-Z0-9!#$=?^_{}~-",
			"msg" : "Email contains illegal characters: %invalid_chars%"
		}
	],
	
	"LOCAL_EMAIL_RFC" : [
		"LOCAL_EMAIL",
		{
			"valid_chars" : ".a-zA-Z0-9!#$%&'*+/=?^_`{|}~-",
			"msg" : "Email contains illegal characters: %invalid_chars%"
		}
	],
	
	"FULL_EMAIL" : [
		{
			"min_length" : "1",
			"msg" : "Email cannot be empty."
		},
		{
			"invalid_chars" : " ",
			"msg" : "Email cannot contain spaces."
		},
		{
			"" : "",
			"msg" : ""
		}
	],
	
	"FULL_EMAIL_CPANEL" : [

	],
	
	"FULL_EMAIL_RFC" : [

	],
	
	"DOMAIN" : [
		
	],
	
	"SUBDOMAIN" : [
		{
			"min_length" : "1",
			"msg" : "Subdomain cannot be empty."
		},
		{
			"max_length" : "63",
			"msg" : "Subdomain cannot be longer than 63 characters."
		},
		{
			"invalid_chars" : " ",
			"msg" : "Subdomain cannot contain spaces."
		},
		{
			"invalid_regexp" : "\\.\\.",
			"msg" : "Subdomain cannot contain two consecutive periods."
		},
		{
			"valid_chars" : "a-zA-Z0-9_-.",
			"msg" : "Subdomain contains invalid characters: %invalid_chars%"
		}
	],
	
	"FQDN" : [
		
	],
	
	"TLD" : [

	],
	
	"FTP_USERNAME" : [

	],
	
	"MYSQL_DB_NAME" : [
		
	],
	
	"MYSQL_USERNAME" : [
		
	],
	
	"POSTGRES_DB_NAME" : [
		
	],
	
	"POSTGRES_USERNAME" : [
		
	]
};

//--- end /usr/local/cpanel/base/cjt//validation_definitions.js ---

//--- start /usr/local/cpanel/base/cjt//widgets.js ---
/*
#                                                 Copyright(c) 2010 cPanel, Inc.
#                                                           All rights Reserved.
# copyright@cpanel.net                                         http://cpanel.net
# This code is subject to the cPanel license. Unauthorized copying is prohibited
*/

(function() {

    // check to be sure the CPANEL global object already exists
    if (typeof CPANEL == "undefined" || !CPANEL) {
        alert('You must include the CPANEL global object before including widgets.js!');
    }
    else {

        /**
        The widgets module contains widget objects used in cPanel.
        @module widgets
*/

        /**
        The widgets class contains widget objects used in cPanel.
        @class widgets
        @namespace CPANEL
        @extends CPANEL
*/
        CPANEL.widgets = {

            Text_Input_Helper : function(context_el, text, before_show) {
                var context_el = DOM.get(context_el);

                var id = context_el.id;
                if (id) {
                    id += "_cjt-text-input-helper";
                }
                else {
                    id = DOM.generateId();
                }

                //adjust the overlay for the context element border and padding
                var region = CPANEL.dom.get_inner_region(context_el);
                var xy_offset = [
                region.padding.left + region.border.left,
                region.padding.top  + region.border.top
                ];

                var opts = {
                    context: [context_el, "tl", "tl", ["beforeShow", "windowResize"], xy_offset],
                    width:   region.width+"px",
                    height:  region.height+"px",
                    zIndex:  parseInt(DOM.getStyle(context_el, "z-index"))+1,
                    visible: false
                };

                arguments.callee.superclass.constructor.call(this, id, opts);


                var render_parent = context_el.parentNode;
                if ( render_parent.nodeName.toLowerCase() === "label" ) {
                    render_parent = render_parent.parentNode;
                }

                this.render( render_parent );

                var overlay = this;
                this.element.onclick = function() {
                    overlay.hide();
                    context_el.focus();
                };

                DOM.addClass(this.element, "cjt-text-input-helper");

                var helper_text = text || "";
                this.setBody(helper_text);

                YAHOO.util.Event.addListener( context_el, "focus", function() {
                    overlay.hide();
                } );
                YAHOO.util.Event.addListener( context_el, "blur", function() {
                    if ( !this.value.trim() ) overlay.show();
                } );

                if ( before_show ) before_show.apply(this);

                if ( !context_el.value.trim() ) this.show();
            },

            // show a progress bar
            progress_bar : function(el, percentage, text, options) {

                // just a legacy thing so I don't have to backmerge a change for 11.25
                if (options == '{"inverse_colors":"true"}') {
                    options = { inverse_colors : true };
                }

                if (! options) options = {};
                if (! options.text_style) options.text_style = "";
                if (! options.inverse_colors) options.inverse_colors = false;
                if (! options.one_color) options.one_color = false;
                if (! options.return_html) options.return_html = false;

                // clean the percentage
                percentage = parseInt(percentage);
                if (percentage < 0) percentage = 0;
                if (percentage > 100) percentage = 100;

                // get the element
                if (options.return_html == false) {
                    el = YAHOO.util.Dom.get(el);
                }

                // set the color of the bar
                var color;
                if (percentage >= 0)  color = '#FF0000';    // red
                if (percentage >= 20) color = '#FF9837';    // orange
                if (percentage >= 40) color = '#F1FF4D';    // yellow
                if (percentage >= 60) color = '#C5FF00';    // chartreuse
                if (percentage >= 80) color = '#8FFF00';    // lt green

                if (options.inverse_colors) {
                    if (percentage >= 0)  color = '#8FFF00';    // lt green
                    if (percentage >= 20) color = '#C5FF00';    // chartreuse
                    if (percentage >= 40) color = '#F1FF4D';    // yellow
                    if (percentage >= 60) color = '#FF9837';    // orange
                    if (percentage >= 80) color = '#FF0000';    // red
                }

                if (options.one_color) {
                    color = options.one_color;
                }

                var height = "100%";
                // BROWSER-SPECIFIC CODE: manually get the height from the parent element for ie6
                if (YAHOO.env.ua.ie == 6 && options.return_html == false) {
                    var div_region = YAHOO.util.Region.getRegion(el);
                    height = div_region.height + "px";
                }

                var html;
                // container div with relative positioning, height/width set to 100% to fit the container element
                html  = '<div class="cpanel_widget_progress_bar" title="' + percentage + '%" style="position: relative; width: 100%; height: ' + height + '; padding: 0px; margin: 0px; border: 0px">';

                // text div fits the width and height of the container div and has it's text vertically centered; has an opaque background and z-index of 1 to put it above the color bar div
                if (text) {
                    html += '<div style="position: absolute; left: 0px; width: 100%; height: ' + height + '; padding: 0px; margin: 0px; border: 0px; z-index: 1; background-image: url(\'/cPanel_magic_revision_0/cjt/images/1px_transparent.gif\')">';
                    html += '<table style="width: 100%; height: 100%; padding: 0px; margin: 0px; border: 0px">';
                    html += '<tr><td valign="middle" style="padding: 0px; margin: 0px; border: 0px;">'; // use a table to vertically center for greatest compatability
                    html += '<div style="width: 100%; ' + options.text_style + '">' + text + '</div>';
                    html += '</td></tr></table>';
                    html += '</div>';
                }

                // color bar div fits the width and height of the container div and width changes depending on the strength of the password
                if (percentage > 0) {
                    html += '<div style="position: absolute; left: 0px; top: 0px; width: ' + percentage + '%; height: ' + height + '; background-color: ' + color + '; padding: 0px; margin: 0px; border: 0px"></div>';
                }

                // close the container div
                html += '</div>';

                // save the percent information in a hidden div
                if (options.return_html == false) {
                    html += '<div class="cpanel_widget_progress_bar_percent" style="display: none">' + percentage + '</div>';
                }

                if (options.return_html == true) {
                    return html;
                }

                el.innerHTML = html;
            },

            build_progress_bar : function(percentage, text, options) {


            },

            // variable used to hold the status box overlay widget
            status_box : null,

            // variable used to hold the status box overlay's timeout
            status_box_timeout : null,

            status : function(message, class_name) {

                // if the status bar is currently being displayed clear the previous timeout
                clearTimeout(this.status_box_timeout);

                var options = {
                    zIndex:1000,
                    visible: true,
                    effect: {effect:YAHOO.widget.ContainerEffect.FADE, duration:0.25}
                };
                this.status_box = new YAHOO.widget.Overlay("cpanel_status_widget", options);
                this.status_box.setBody('<span class="cpanel_status_widget_message">' + message + '</span>');

                var footer = '<br /><div style="width: 100%; text-align: right; font-size: 10px">';
                footer += CPANEL.lang.click_to_close + ' [<span id="cpanel_status_widget_countdown">10</span>]';
                footer += '</div>';
                this.status_box.setFooter(footer);
                this.status_box.render(document.body);

                YAHOO.util.Dom.removeClass("cpanel_status_widget", "cpanel_status_success");
                YAHOO.util.Dom.removeClass("cpanel_status_widget", "cpanel_status_error");
                YAHOO.util.Dom.removeClass("cpanel_status_widget", "cpanel_status_warning");
                if (class_name) {
                    YAHOO.util.Dom.addClass("cpanel_status_widget", "cpanel_status_" + class_name);
                }
                else {
                    YAHOO.util.Dom.addClass("cpanel_status_widget", "cpanel_status_success");
                }

                var hide_me = function() {
                    CPANEL.widgets.status_box.hide();
                    clearTimeout(CPANEL.widgets.status_box_timeout);
                };

                YAHOO.util.Event.on("cpanel_status_widget", "click", hide_me);

                var second_decrease = function() {
                    var seconds_el = YAHOO.util.Dom.get("cpanel_status_widget_countdown");
                    if (seconds_el) {
                        var seconds = parseInt(seconds_el.innerHTML);

                        // close the window when the countdown is finished
                        if (seconds == 0) {
                            hide_me();
                        }
                        // else decrease the counter and set a new timeout
                        else {
                            seconds_el.innerHTML = seconds-1;
                            CPANEL.widgets.status_box_timeout = setTimeout(second_decrease, 1000);
                        }
                    }
                };

                // initialize the first timeout
                this.status_box_timeout = setTimeout(second_decrease, 1000);
            },

            // status_bar widget
            /*
            var status_bar_options = {
            duration : integer,
            callbackFunc : function literal,
            hideCountdown : true,
            noCountdown : true,
            rawHTML : HTML string
            }
            */
            status_bar : function(el, style, title, message, options) {
                var duration = 10;
                if (style == "error") duration = 0;

                // options
                var callback_func = function() {};
                var hide_countdown = false;
                var countdown = true;
                if (duration == 0) countdown = false;
                var raw_html = false;
                if (options) {
                    if (options.duration) duration = options.duration;
                    if (options.callbackFunc) {
                        if (typeof(options.callbackFunc) == "function") callback_func = options.callbackFunc;
                    }
                    if (options.hideCountdown) hide_countdown = true;
                    if (options.rawHTML) raw_html = options.rawHTML;
                    if (options.noCountdown) countdown = false;
                }

                el = YAHOO.util.Dom.get(el);
                if (! el) {
                    alert("Error in CPANEL.widgets.status_bar: '" + el + "' does not exist in the DOM.");
                    return;
                }

                var hide_bar = function() {
                    CPANEL.animate.slide_up( el, function() {
                        el.innerHTML = '';
                        callback_func();
                        CPANEL.align_panels_event.fire();
                    });
                };

                // set the style class
                YAHOO.util.Dom.removeClass(el, "cjt_status_bar_success");
                YAHOO.util.Dom.removeClass(el, "cjt_status_bar_error");
                YAHOO.util.Dom.removeClass(el, "cjt_status_bar_warning");
                YAHOO.util.Dom.addClass(el, "cjt_status_bar_" + style);

                var status = '';
                if (raw_html == false) {
                    status = CPANEL.icons.success;
                    if (style == "error") status = CPANEL.icons.error;
                    if (style == "warning") status = CPANEL.icons.warning;

                    status += " <strong>" + title + "</strong>";
                    if (message) {
                        if (message != "") {
                            status += '<div style="height: 5px"></div>';
                            status += CPANEL.util.convert_breaklines(message);
                        }
                    }
                }
                else {
                    status = raw_html;
                }

                var countdown_div = '';
                if (countdown == true) {
                    countdown_div = '<div class="cjt_status_bar_countdown"';
                    if (hide_countdown == true) countdown_div += ' style="display: none"';
                    countdown_div += '>click to close [<span id="' + el.id + '_countdown">' + duration + '</span>]</div>';
                }
                else {
                    countdown_div = '<div class="cjt_status_bar_countdown">click to close</div>';
                }

                el.innerHTML = status + countdown_div;

                CPANEL.animate.slide_down( el, function() {
                    // give the status bar element "hasLayout" property in IE
                    if (YAHOO.env.ua.ie > 5) {
                        YAHOO.util.Dom.setStyle(el, "zoom", "1");
                    }
                    if (countdown == true) CPANEL.util.countdown(el.id + "_countdown", hide_bar);
                    CPANEL.align_panels_event.fire();
                });

                YAHOO.util.Event.on(el, "click", hide_bar);
            },

            collapsible_header : function(header_el, div_el, before_show, after_show, before_hide, after_hide) {
                // grab the DOM elements
                header_el = YAHOO.util.Dom.get(header_el);
                div_el = YAHOO.util.Dom.get(div_el);

                if (! header_el) {
                    alert("Error in CPANEL.widgets.collapsable_header: header_el '" + header_el + "' does not exist in the DOM.");
                    return;
                }
                if (! div_el) {
                    alert("Error in CPANEL.widgets.collapsable_header: div_el '" + div_el + "' does not exist in the DOM.");
                    return;
                }

                // set up the functions if they are not defined
                if (! before_show || typeof(before_show) != "function") before_show = function() {};
                if (! after_show  || typeof(after_show)  != "function") after_show = function() {};
                if (! before_hide || typeof(before_hide) != "function") before_hide = function() {};
                if (! after_hide  || typeof(after_hide)  != "function") after_hide = function() {};

                // toggle function
                var toggle_function = function() {
                    // if the display is none, expand the div
                    if (YAHOO.util.Dom.getStyle(div_el, "display") == "none") {
                        before_show();
                        YAHOO.util.Dom.replaceClass(header_el, "cjt_header_collapsed", "cjt_header_expanded");
                        CPANEL.animate.slide_down( div_el, function() {
                            after_show();
                            CPANEL.align_panels_event.fire();
                        });
                    }
                    // else hide it
                    else {
                        before_hide();
                        CPANEL.animate.slide_up( div_el, function() {
                            after_hide();
                            YAHOO.util.Dom.replaceClass(header_el, "cjt_header_expanded", "cjt_header_collapsed");
                            CPANEL.align_panels_event.fire();
                        });
                    }
                };

                // add the event handler
                YAHOO.util.Event.on(header_el, "click", toggle_function);
            }

        } // end widgets object

        YAHOO.lang.extend( CPANEL.widgets.Text_Input_Helper, YAHOO.widget.Overlay );

        var _is_ie6_or_7 = YAHOO.env.ua.ie && (YAHOO.env.ua.ie <= 7);
        if ( _is_ie6_or_7 ) {
            var ie_shell_prototype;  //lazy-load this value
            CPANEL.widgets.Text_Input_Helper.prototype.setBody = function(content) {
                if ( content.nodeName ) {
                    if ( !ie_shell_prototype ) {
                        ie_shell_prototype = document.createElement("div");
                        ie_shell_prototype.className = "cjt-ie-shell";
                    }
                    var ie_shell = ie_shell_prototype.cloneNode(false);
                    ie_shell.appendChild(content);
                }
                else {
                    content = "<div class=\"cjt-ie-shell\">"+content+"</div>";
                }

                return this.constructor.superclass.setBody.call(this,content);
            };
        }

//class Notice
//extends YAHOO.widget.Module
//
//In-page notifications that slide down on show
//opts:
//  content   : HTML content of the notice
//  level     : one of "success", "info", "warn", "error"
//  container : ID or node reference of the container (default "cjt_notice_container")
//  replaces  : a Notice object, ID, or DOM node that this instance will replace
        var Notice = function(id, opts) {
            if ( typeof id === "object" ) {
                opts = id;
                id = DOM.generateId();
            }
            else if (!id) {
                id = DOM.generateId();
            }

            Notice.superclass.constructor.call( this, DOM.generateId(), opts );
        };
        Notice.CLASS = "cjt_notice";
        Notice.DEFAULT_CONTAINER_ID = "cjt_notice_container";
        Notice.CLASSES = {
            success: "cjt_notice_success",
            info   : "cjt_notice_info",
            warn   : "cjt_notice_warn",
            error  : "cjt_notice_error"
        };
        YAHOO.lang.extend( Notice, YAHOO.widget.Module, {
            render : function(render_obj, mod_el) {
                var container;
                if (render_obj) {
                    container = DOM.get(render_obj);
                }

                if (container) {
                    this.cfg.queueProperty("container",container);
                }
                else {
                    var container_property = this.cfg.getProperty("container");
                    container = DOM.get(container_property);

                    if (!container) {
                        container = document.body;
                        this.cfg.queueProperty("container",container);
                    }
                }

                var visible = this.cfg.getProperty("visible");
                if (visible) this.element.style.display = "none";

                var ret = Notice.superclass.render.call( this, container, mod_el );

                if (visible) this.animated_show();

                return ret;
            },
            init : function(el, opts) {
                Notice.superclass.init.call(this, el/*, opts */);

                this.beforeInitEvent.fire(Notice);

                DOM.addClass( this.element, Notice.CLASS );

                if ( opts ) {
                    this.cfg.applyConfig(opts, true);
                    this.render();
                }

                this.initEvent.fire(Notice);
            },
            animated_show : function() {
                this.beforeShowEvent.fire();

                var replacee = this.cfg.getProperty("replaces");
                if (replacee) {
                    if ( typeof replacee === "string" ) {
                        replacee = DOM.get(replacee);
                    }
                    else if ( replacee instanceof Notice ) {
                        replacee = replacee.element;
                    }
                }
                if (replacee) {
                    var container = DOM.get( this.cfg.getProperty("container") );
                    container.insertBefore( this.element, DOM.getNextSibling(replacee) || undefined );
                    var rep_slide = CPANEL.animate.slide_up( replacee );
                    if ( replacee instanceof Notice ) {
                         rep_slide.onComplete.subscribe( replacee.destroy, replacee, true );
                    }
                }

                var ret = CPANEL.animate.slide_down( this.element );

                this.showEvent.fire();

                this.cfg.setProperty("visible", true, true);

                return ret;
            },
            initDefaultConfig : function() {
                Notice.superclass.initDefaultConfig.call(this);

                this.cfg.addProperty("replaces", { value: null });
                this.cfg.addProperty("level", {
                    value:   "info",    //default to "info" level
                    handler: this.config_level
                } );
                this.cfg.addProperty("content", {
                    value:   "",
                    handler: this.config_content
                } );
                this.cfg.addProperty("container", {
                    value:   Notice.DEFAULT_CONTAINER_ID
                } );
            },
            config_content : function(type, args, obj) {
                var content = args[0];
                this.setBody("<div class=\"cjt_notice_content\">"+content+"</div>");
                this._content_el = this.body.firstChild;
            },
            config_level : function(type, args, obj) {
                var level = args[0];
                var level_class = level && Notice.CLASSES[level];
                if (level_class) {
                    if (this._level_class) {
                        DOM.replaceClass(this.element, this._level_class, level_class);
                    }
                    else {
                        DOM.addClass(this.element, level_class);
                    }
                    this._level_class = level_class;
                }
            }
        } );
        CPANEL.widgets.Notice = Notice;

    } // end else statement
})();

//--- end /usr/local/cpanel/base/cjt//widgets.js ---

//--- start /usr/local/cpanel/base/cjt//yuiextras.js ---
/*  
    #                                                 Copyright(c) 2010 cPanel, Inc.
    #                                                           All rights Reserved.
    # copyright@cpanel.net                                         http://cpanel.net
    # This code is subject to the cPanel license. Unauthorized copying is prohibited
*/

( function() {

//Add a "noscroll" config option: the panel will not scroll with the page.
//Works by wrapping the panel element in a position:fixed <div>.
//NOTE: This only works when initializing the panel.
if ( ('YAHOO' in window) && YAHOO.widget && YAHOO.widget.Panel ) {
    var _old_init = YAHOO.widget.Panel.prototype.init;
    YAHOO.widget.Panel.prototype.init = function(el, userConfig) {
        _old_init.apply(this,arguments);

        this.cfg.addProperty('noscroll', {
            value: !!userConfig && !!userConfig.noscroll
        } );
    };

    var _old_initEvents = YAHOO.widget.Panel.prototype.initEvents;
    YAHOO.widget.Panel.prototype.initEvents = function() {
        _old_initEvents.apply(this,arguments);

        this.renderEvent.subscribe( function() {
            if ( this.cfg.getProperty('noscroll') ) {
                wrapper_div = document.createElement('div');
                wrapper_div.style.position = 'fixed';

                var parent_node = this.element.parentNode;
                parent_node.insertBefore(wrapper_div,this.element);
                wrapper_div.appendChild(this.element);
                this.wrapper = wrapper_div;
            }
        } );
    };
}


//YUI 2's Overlay context property does not factor in margins of either the
//context element or the overlay element. This change makes it look for a
//margin on the overlay element (not the context element) and add that to
//whatever offset may have been passed in.
//See YUI 3 feature request 25298897.
if ( !YAHOO.widget.Overlay._offset_uses_margin ) {
    var Overlay = YAHOO.widget.Overlay;
    var _align = Overlay.prototype.align;
    var _margins_to_check = {};
    _margins_to_check[Overlay.TOP_LEFT] =     ["margin-top","margin-left"];
    _margins_to_check[Overlay.TOP_RIGHT] =    ["margin-top","margin-right"];
    _margins_to_check[Overlay.BOTTOM_LEFT] =  ["margin-bottom", "margin-left"];
    _margins_to_check[Overlay.BOTTOM_RIGHT] = ["margin-bottom", "margin-right"];

    Overlay.prototype.align = function(el_align, context_align, xy_offset) {
        if ( !el_align ) return _align.apply(this,arguments);

        var el = this.element;
        var margins = _margins_to_check[el_align];
        var el_y_offset = parseInt(DOM.getStyle(el, margins[0])) || 0;
        var el_x_offset = parseInt(DOM.getStyle(el, margins[1])) || 0;

        if (el_x_offset) {
            var x_offset_is_negative = (el_align === Overlay.BOTTOM_RIGHT) || (el_align === Overlay.TOP_RIGHT);
            if (x_offset_is_negative) el_x_offset *= -1;
        }

        if (el_y_offset) {
            var y_offset_is_negative = (el_align === Overlay.BOTTOM_LEFT) || (el_align === Overlay.BOTTOM_RIGHT);
            if (y_offset_is_negative) el_y_offset *= -1;
        }

        if (el_x_offset || el_y_offset) {
            var new_xy_offset;
            if (xy_offset) {
                new_xy_offset = [ xy_offset[0]+el_x_offset, xy_offset[1]+el_y_offset ];
            }
            else {
                new_xy_offset = [ el_x_offset, el_y_offset ];
            }
            return _align.call(this, el_align, context_align, new_xy_offset);
        }
        else {
            return _align.apply(this,arguments);
        }
    };

    Overlay._offset_uses_margin = true;
}

//HTML forms don't usually submit from ENTER unless they have a submit
//button, which YUI Dialog forms do not have by design. Moreover, they *do*
//submit if there is just one text field. To smooth out these peculiarities:
//1) Add a dummy <input type="text"> to kill native ENTER submission.
//2) Listen for keydown events on dialog box and run submit() from them.
if ( !YAHOO.widget.Dialog._handles_enter ) {
    var _registerForm = YAHOO.widget.Dialog.prototype.registerForm;
    YAHOO.widget.Dialog.prototype.registerForm = function() {
        _registerForm.apply(this,arguments);

        if ( !this._cjt_dummy_input ) {
            var dummy_input = document.createElement("input");
            dummy_input.style.display = "none";
            this.form.appendChild(dummy_input);
            this._cjt_dummy_input = dummy_input;
        }
    };

    //YUI 2 KeyListener does not make its own copy of the key data object
    //that it receives when the KeyListener is created; as a result, it is
    //possible to alter the listener by changing the key data object after
    //creating the KeyListener. It's also problematic that KeyListener doesn't
    //make that information available to us after creating the listener.
    //We fix both of these issues here.
    var _key_listener = YAHOO.util.KeyListener;
    var new_key_listener = function(attach_to, key_data, handler, event) {
        var new_key_data = {};
        for (var key in key_data) new_key_data[key] = key_data[key];
        this.key_data = new_key_data;

        _key_listener.call( this, attach_to, new_key_data, handler, event );
    };
    YAHOO.lang.extend( new_key_listener, _key_listener );
    YAHOO.lang.augmentObject( new_key_listener, _key_listener );   //static properties

    //We want all dialog boxes to submit when their form receives ENTER.
    //Check for this immediately after init();
    var _init = YAHOO.widget.Dialog.prototype.init;
    YAHOO.widget.Dialog.prototype.init = function( el, cfg ) {
        var ret = _init.apply(this,arguments);

        var key_listeners = this.cfg.getProperty("keylisteners");

        var need_to_add_enter = !key_listeners;

        if (key_listeners) {
            if ( !(key_listeners instanceof Array) ) {
                key_listeners = [key_listeners];
            }

            need_to_add_enter = !key_listeners.some( function(kl) {
                if ( !kl.key_data ) return false;

                if ( kl.key_data.keys === 13 ) return true;

                if ( kl.key_data.indexOf && kl.key_data.indexOf(13) !== -1 ) return true;

                return false;
            } );
        }
        else {
            key_listeners = [];
            need_to_add_enter = true;
        }

        if (need_to_add_enter) {
            var the_dialog = this;
            key_listeners.push( new YAHOO.util.KeyListener( document.body, {keys:13}, function(type, args) {
                if (the_dialog.cfg.getProperty("postmethod") !== "form") {
                    var original = EVENT.getTarget(args[1]);
                    if (original && original.form === the_dialog.form) {
                        the_dialog.submit();
                    }
                }
            } ) );

            this.cfg.setProperty("keylisteners", key_listeners);
        }

        return ret;
    };

    YAHOO.widget.Dialog._handles_enter = true;
}

})();

//--- end /usr/local/cpanel/base/cjt//yuiextras.js ---
