(function() {
    tinymce.create('tinymce.plugins.showifhasone', {
        init : function(ed, url) {
            ed.addButton('showifhasone', {
                title : 'Show If Has One - Displays content only for members who are logged in and have ANY of the membership levels listed',
                image : '../wp-content/plugins/membership-simplified-for-oap-members-only/images/siho.png',
                onclick : function() {
                     ed.selection.setContent('[show_if has_one="Add,Your,Levels,Separated,by,Commas"] ' + ed.selection.getContent() + ' [/show_if]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('showifhasone', tinymce.plugins.showifhasone);
})();(function() {    tinymce.create('tinymce.plugins.showifhasone', {        init : function(ed, url) {            ed.addButton('showifhasone', {                title : 'Show If Has One - Shortcode',                image : url+'/siho.png',                onclick : function() {                     ed.selection.setContent('[show_if has_one="Add,Your,Levels,Separated,by,Commas"] ' + ed.selection.getContent() + ' [/show_if]');                }            });        },        createControl : function(n, cm) {            return null;        },    });    tinymce.PluginManager.add('showifhasone', tinymce.plugins.showifhasone);})();
(function() {
    tinymce.create('tinymce.plugins.showifhasall', {
        init : function(ed, url) {
            ed.addButton('showifhasall', {
                title : 'Show If Has All - Displays content only for members who are logged in and have ALL of the membership levels listed',
                image : '../wp-content/plugins/membership-simplified-for-oap-members-only/images/siha.png',
                onclick : function() {
                     ed.selection.setContent('[show_if has_all="Add,Your,Levels,Separated,by,Commas"] ' + ed.selection.getContent() + ' [/show_if]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('showifhasall', tinymce.plugins.showifhasall);
})();(function() {    tinymce.create('tinymce.plugins.showifhasall', {        init : function(ed, url) {            ed.addButton('showifhasall', {                title : 'Show If Has All - Shortcode',                image : url+'/siha.png',                onclick : function() {                     ed.selection.setContent('[show_if has_all="Add,Your,Levels,Separated,by,Commas"] ' + ed.selection.getContent() + ' [/show_if]');                }            });        },        createControl : function(n, cm) {            return null;        },    });    tinymce.PluginManager.add('showifhasall', tinymce.plugins.showifhasall);})();
(function() {
    tinymce.create('tinymce.plugins.showifnotone', {
        init : function(ed, url) {
            ed.addButton('showifnotone', {
                title : 'Show If Not One - Displays content only for members who are logged in and do NOT have at least ONE of the membership levels listed',
                image : '../wp-content/plugins/membership-simplified-for-oap-members-only/images/sin1.png',
                onclick : function() {
                     ed.selection.setContent('[show_if not_one="Add,Your,Levels,Separated,by,Commas"] ' + ed.selection.getContent() + ' [/show_if]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('showifnotone', tinymce.plugins.showifnotone);
})();(function() {    tinymce.create('tinymce.plugins.showifnotone', {        init : function(ed, url) {            ed.addButton('showifnotone', {                title : 'Show If Not One - Shortcode',                image : url+'/sin1.png',                onclick : function() {                     ed.selection.setContent('[show_if not_one="Add,Your,Levels,Separated,by,Commas"] ' + ed.selection.getContent() + ' [/show_if]');                }            });        },        createControl : function(n, cm) {            return null;        },    });    tinymce.PluginManager.add('showifnotone', tinymce.plugins.showifnotone);})();
(function() {
    tinymce.create('tinymce.plugins.showifnotall', {
        init : function(ed, url) {
            ed.addButton('showifnotall', {
                title : 'Show If Not All - Displays content only for members who are logged in and do NOT have ALL of the membership levels listed',
                image : '../wp-content/plugins/membership-simplified-for-oap-members-only/images/sina.png',
                onclick : function() {
                     ed.selection.setContent('[show_if not_all="Add,Your,Levels,Separated,by,Commas"] ' + ed.selection.getContent() + ' [/show_if]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('showifnotall', tinymce.plugins.showifnotall);
})();(function() {    tinymce.create('tinymce.plugins.showifnotall', {        init : function(ed, url) {            ed.addButton('showifnotall', {                title : 'Show If Not All - Shortcode',                image : url+'/sina.png',                onclick : function() {                     ed.selection.setContent('[show_if not_all="Add,Your,Levels,Separated,by,Commas"] ' + ed.selection.getContent() + ' [/show_if]');                }            });        },        createControl : function(n, cm) {            return null;        },    });    tinymce.PluginManager.add('showifnotall', tinymce.plugins.showifnotall);})();
(function() {
    tinymce.create('tinymce.plugins.showifhastag', {
        init : function(ed, url) {
            ed.addButton('showifhastag', {
                title : 'Show If Has Tag - Displays content only for members who are logged in and have the tag indicated by "Tag"',
                image : '../wp-content/plugins/membership-simplified-for-oap-members-only/images/siht.png',
                onclick : function() {
                     ed.selection.setContent('[show_if has_tag="Add,Your,Levels,Separated,by,Commas"] ' + ed.selection.getContent() + ' [/show_if]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('showifhastag', tinymce.plugins.showifhastag);
})();(function() {    tinymce.create('tinymce.plugins.showifhastag', {        init : function(ed, url) {            ed.addButton('showifhastag', {                title : 'Show If Has Tag - Shortcode',                image : url+'/siht.png',                onclick : function() {                     ed.selection.setContent('[show_if has_tag="Add,Your,Levels,Separated,by,Commas"] ' + ed.selection.getContent() + ' [/show_if]');                }            });        },        createControl : function(n, cm) {            return null;        },    });    tinymce.PluginManager.add('showifhastag', tinymce.plugins.showifhastag);})();
(function() {
    tinymce.create('tinymce.plugins.showifiscontact', {
        init : function(ed, url) {
            ed.addButton('showifiscontact', {
                title : 'Show If Is Contact - Displays content if visitor is an identified contact in your database',
                image : '../wp-content/plugins/membership-simplified-for-oap-members-only/images/siic.png',
                onclick : function() {
                     ed.selection.setContent('[show_if is_contact] ' + ed.selection.getContent() + ' [/show_if]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('showifiscontact', tinymce.plugins.showifiscontact);
})();(function() {    tinymce.create('tinymce.plugins.showifiscontact', {        init : function(ed, url) {            ed.addButton('showifiscontact', {                title : 'Show If Is Contact - Shortcode',                image : url+'/siic.png',                onclick : function() {                     ed.selection.setContent('[show_if is_contact] ' + ed.selection.getContent() + ' [/show_if]');                }            });        },        createControl : function(n, cm) {            return null;        },    });    tinymce.PluginManager.add('showifiscontact', tinymce.plugins.showifiscontact);})();
(function() {
    tinymce.create('tinymce.plugins.showifnotcontact', {
        init : function(ed, url) {
            ed.addButton('showifnotcontact', {
                title : 'Show If Is Contact - Displays content if visitor is NOT an identified contact in your database',
                image : '../wp-content/plugins/membership-simplified-for-oap-members-only/images/sinc.png',
                onclick : function() {
                     ed.selection.setContent('[show_if not_contact] ' + ed.selection.getContent() + ' [/show_if]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('showifnotcontact', tinymce.plugins.showifnotcontact);
})();(function() {    tinymce.create('tinymce.plugins.showifnotcontact', {        init : function(ed, url) {            ed.addButton('showifnotcontact', {                title : 'Show If Not Contact - Shortcode',                image : url+'/sinc.png',                onclick : function() {                     ed.selection.setContent('[show_if not_contact] ' + ed.selection.getContent() + ' [/show_if]');                }            });        },        createControl : function(n, cm) {            return null;        },    });    tinymce.PluginManager.add('showifnotcontact', tinymce.plugins.showifnotcontact);})();