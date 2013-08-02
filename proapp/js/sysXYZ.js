$(document).ready(function(){

$('input:radio').change(function(){
    var numOfx = $('.a:checked').length;
    var numOfy = $('.b:checked').length; 
    var numOfz = $('.c:checked').length; 

    $('.a_results').text(numOfx);
    $('.b_results').text(numOfy);                        
    $('.c_results').text(numOfz);

    $('input.a_results').val(numOfx);
    $('input.b_results').val(numOfy);                        
    $('input.c_results').val(numOfz);
});
    

console.log('LOADED!');

});