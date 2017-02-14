/**
 * Created by ismail on 11-02-17.
 */

jQuery(document).ready(function( $ ) {
    console.log( "google drive ready!" );

    // The Browser API key obtained from the Google API Console.
    // Replace with your own Browser API key, or your own key.
    var developerKey = 'AIzaSyAwf9FXo5Rvc-bUaH1rcsTXKgqU7KduHZU';

    // The Client ID obtained from the Google API Console. Replace with your own Client ID.
    var clientId = "691082654551-6onkio4nk6mgbfo03m49gfmm9b47iaa7.apps.googleusercontent.com"

    // Replace with your own project number from console.developers.google.com.
    // See "Project number" under "IAM & Admin" > "Settings"
    var appId = "691082654551";

    // Scope to use to access user's Drive items.
    var scope = ['https://www.googleapis.com/auth/drive'];

    var pickerApiLoaded = false;
    var oauthToken;

    // Use the Google API Loader script to load the google.picker script.
    function loadPicker() {
        console.log( "loadPicker" );
        gapi.load('auth', {'callback': onAuthApiLoad});
        gapi.load('picker', {'callback': onPickerApiLoad});
    }

    function onAuthApiLoad() {
        window.gapi.auth.authorize(
            {
                'client_id': clientId,
                'scope': scope,
                'immediate': false
            },
            handleAuthResult);
    }

    function onPickerApiLoad() {
        pickerApiLoaded = true;
        createPicker();
    }

    function handleAuthResult(authResult) {
        if (authResult && !authResult.error) {
            oauthToken = authResult.access_token;
            createPicker();
        }
    }

    // Create and render a Picker object for searching images.
    function createPicker() {
        if (pickerApiLoaded && oauthToken) {
            var view = new google.picker.View(google.picker.ViewId.DOCS);
            view.setMimeTypes("application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            var picker = new google.picker.PickerBuilder()
                .enableFeature(google.picker.Feature.NAV_HIDDEN)
                .enableFeature(google.picker.Feature.MULTISELECT_ENABLED)
                .setAppId(appId)
                .setOAuthToken(oauthToken)
                .addView(view)
                .addView(new google.picker.DocsUploadView())
                .setDeveloperKey(developerKey)
                .setLocale('nl')
                .setCallback(pickerCallback)
                .build();
            picker.setVisible(true);
        }
    }

    // A simple callback implementation.
    function pickerCallback(data) {
        if (data.action == google.picker.Action.PICKED) {
            var fileId = data.docs[0].id;

            console.log('The user selected: ' + fileId);
            console.log(oauthToken);
            console.log(data.docs[0]);
            //printFile(fileId);
            //downloadFile();

            var url = "https://www.googleapis.com/drive/v3/files/" + fileId + "?alt=media";
            // TODO First validate the excel file
            $.post( "/dealer/importcloud", {url: url, oauthToken: oauthToken});

        }
    }


    /**
     * Print a file's metadata.
     *
     * @param {String} fileId ID of the file to print metadata for.
     */
    function printFile(fileId) {
        var request = gapi.client.drive.files.get({
            'fileId': fileId
        });
        request.execute(function(resp) {
            console.log('Title: ' + resp.title);
            console.log('Description: ' + resp.description);
            console.log('MIME type: ' + resp.mimeType);
        });
    }

    /**
     * Download a file's content.
     *
     * @param {File} file Drive File instance.
     * @param {Function} callback Function to call when the request is complete.
     */
    function downloadFile(file, callback) {
        if (file.downloadUrl) {
            var accessToken = gapi.auth.getToken().access_token;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', file.downloadUrl);
            xhr.setRequestHeader('Authorization', 'Bearer ' + accessToken);
            xhr.onload = function() {
                callback(xhr.responseText);
            };
            xhr.onerror = function() {
                callback(null);
            };
            xhr.send();
        } else {
            callback(null);
        }
    }

    $('#pick_drive').on('click', loadPicker);

});



