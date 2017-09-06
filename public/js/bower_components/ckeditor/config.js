/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';
    config.toolbar_Forum =
        [
            [
                'Bold', 'Italic', 'Underline', '-', 'TextColor', 'BGColor', '-',
                'NumberedList', 'BulletedList', '-',
                'Link', 'Unlink', '-',
                'Undo', 'Redo'
            ],
            [
                'Outdent', 'Indent', '-',
                'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord',
                '-', 'Maximize'
            ],
            [
                'CodeSnippet'
            ]

        ];
    config.toolbarGroups = [
        {name: 'document', groups: ['mode', 'document', 'doctools']},
        {name: 'clipboard', groups: ['clipboard', 'undo']},
        {name: 'editing', groups: ['find', 'selection', 'spellchecker']},
        {name: 'forms'},
        '/',
        {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
        {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi']},
        {name: 'links'},
        {name: 'insert'},
        '/',
        {name: 'styles'},
        {name: 'colors'},
        {name: 'tools'},
        {name: 'others'}
    ];
};
