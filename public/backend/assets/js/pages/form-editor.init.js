$(document).ready(function () {
    0 < $("#elm1").length &&
        tinymce.init({
            selector: "textarea#elm1",
            paste_preprocess: function (plugin, args) {
                console.log("Attempted to paste: ", args.content);
                // replace copied text with empty string
                args.content = '';
            },
        });
    0 < $("#elm2").length &&
        tinymce.init({
            selector: "textarea#elm2",
            paste_preprocess: function (plugin, args) {
                console.log("Attempted to paste: ", args.content);
                // replace copied text with empty string
                args.content = '';
            },
        });
    0 < $("#elm3").length &&
        tinymce.init({
            selector: "textarea#elm3",
            paste_preprocess: function (plugin, args) {
                console.log("Attempted to paste: ", args.content);
                // replace copied text with empty string
                args.content = '';
            },
        });
    0 < $("#elm4").length &&
        tinymce.init({
            selector: "textarea#elm4",
            paste_preprocess: function (plugin, args) {
                console.log("Attempted to paste: ", args.content);
                // replace copied text with empty string
                args.content = '';
            },
        });
});
