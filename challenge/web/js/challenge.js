// Objeto de acesso global
Challenge = {};



(function() {

    var pub = Challenge;


    pub.processFile = (filename) => {
        priv.processFile(filename);
    }

    pub.deleteFileInFolder = (filename) => {
        priv.deleteFileInFolder(filename);
    }



    var priv = {};

    jQuery(function($) {

        $(document).ready(() => {


            priv.activeDropzone(); //  Active drag and drop plugin
            priv.updateFileList(); //  List Files in Table
        })

        $(document).on('click','.execute', priv.processQueue);



    });

    priv.processQueue = () =>{
        var myDropzone = Dropzone.forElement(".dropzone");
        myDropzone.processQueue();

    }


    priv.updateFileList = () =>{
        url = "/document/list" ;

        $('.listaArquivos').html('');

        $.ajax({
            url: url,
            type:"get",
            success: (result) => {
                $('.listaArquivos').html(result);
            }
        });
    }



    priv.activeDropzone = () =>{

        $("div#formUpload").dropzone({
            thumbnailWidth: 180,
            thumbnailHeight: 80,
            parallelUploads: 20,
            addRemoveLinks: true,
            dictResponseError: 'Servidor não configurado',
            dictDefaultMessage: 'Arraste seus arquivos aqui :)',
            acceptedFiles: ".xml",
            init:function(){
                var self = this;
                // config
                self.options.addRemoveLinks = true;
                self.options.dictRemoveFile = "Delete";
                //New file added
                self.on("addedfile", function (file) {
                    console.log('new file added ', file);
                });
                // Send file starts
                self.on("sending", function (file) {
                    console.log('upload started', file);
                    $('.meter').show();
                });

                // File upload Progress
                self.on("totaluploadprogress", function (progress) {
                    console.log("progress ", progress);
                    $('.roller').width(progress + '%');
                });

                self.on("queuecomplete", function (progress) {
                    // $('.meter').delay(999).slideUp(999);
                    priv.updateFileList();
                    self.removeAllFiles();
                });

                // On removing file
                self.on("removedfile", function (file) {
                    console.log(file);
                });
            }

        });
    }


    priv.processFile = (id) => {
        //console.log('processar' + id);
        url = "/document/process/"+id ;
        $.ajax({
            url: url,
            type:"get",
            success: (result) => {
                //console.log(result);
                $('span.successMessage').html(result);
                $(".success").fadeTo(2000, 500).slideUp(500, function(){
                    $("#success-alert").slideUp(500);
                });
                priv.updateFileList();
            },
            error:(result) =>{
                $('.problem').show();
            }
        });

    }

    priv.deleteFileInFolder = (id) => {

        url = "/document/delete/"+id ;

        $.ajax({
            url: url,
            type:"get",
            success: (result) => {
               console.log(result);
               priv.updateFileList();
            }
        });

    }


})();