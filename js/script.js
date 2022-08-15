
//  $( function() {
//     $( "#datepicker" ).datepicker();
//   } );


$("#demoDialog1").on('click', function(){
    $.Dialog({
        overlay: true,
        shadow: true,
        flat: true,
        icon: '<img src="images/excel2013icon.png">',
        title: 'Flat window',
        content: '',
        onShow: function(_dialog){
            var content = _dialog.children('.content');
            content.html('Set content from event onShow');
        }
    });
});