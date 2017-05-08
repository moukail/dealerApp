/**
 * Created by ismail on 12-02-17.
 */

jQuery(function($){
    // Your jQuery code here, using $ to refer to jQuery.

    console.log( "ready!" );
    //$('#pick_dropbox').on('click',loadPicker);
    $('#pick_dropbox').on('click', function (e) {
        console.log( "click" );

        options = {

            // Required. Called when a user selects an item in the Chooser.
            success: function(files) {
                console.log("Here's the file link: " + files[0].link);
                console.log(files[0]);
            },

            // Optional. Called when the user closes the dialog without selecting a file
            // and does not include any parameters.
            cancel: function() {

            },

            // Optional. "preview" (default) is a preview link to the document for sharing,
            // "direct" is an expiring link to download the contents of the file. For more
            // information about link types, see Link types below.
            linkType: "direct", // or "preview"

            // Optional. A value of false (default) limits selection to a single file, while
            // true enables multiple file selection.
            multiselect: false, // or true

            // Optional. This is a list of file extensions. If specified, the user will
            // only be able to select files with these extensions. You may also specify
            // file types, such as "video" or "images" in the list. For more information,
            // see File types below. By default, all extensions are allowed.
            extensions: ['.xls', '.xlsx'],
        };
        Dropbox.choose(options);
    });
});