/*=========================================================================================
  File Name: service-manager.js
  Description: Fichier qui permet de gérer les services de la plate forme (pour les agents.)
  ----------------------------------------------------------------------------------------
  Author: RoanldTchuekou
  Author email: ronaldtchuekou@gmail.com
==========================================================================================*/

/**
 * Fonction qui permet de gérer le formulaire d'ajout/modification de categorie de courriers.
 */
 function manager_cat_from(){
    const form = $("#cat_form");

    $(form).submit((e)=>{
        e.preventDefault();
        const category_input = $("#cat_form #category");
        let category = category_input.val(),
            action = e.target.getAttribute("action");

        let progress = set_progress_block(
            document.querySelector('#cat-form-content')
        );

        axios.post(HOST_BACKEND + action, {
            category: category,
        }).then(response => {

            let status = response.status;
          let data = response.data;

            // If 201
            if(status == 201){
                toastr.warning(data, '', { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e4})
            }

            // If 202
            if(status == 202){
                toastr.warning('😥' + data, '', { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e4})
            }

            // If 200
            if(status == 200){
              let cat = data.record;
                let id = cat.id, intitule = cat.intitule, edit = cat.edit, title = '';


                if(edit){ // Pour le mode mise à jour.
                    title = 'Catégorie mis à jour avec succès.';
                    $('#item-' + id).html(
                        `<span class="text-truncate">
                        ${id} <i class="feather icon-minus"></i> ${intitule}
                        </span>
                        <div class="options d-flex">
                            <span class="cursor-pointer edit" data-id="${id}" data-intitule="${intitule}"><i class="feather icon-edit-2"></i></span>
                            <span class="cursor-pointer delete" data-id="${id}"><i class="feather icon-trash"></i></span>
                        </div>`
                    );
                }else{ // Pour le mode ajout.
                    title = 'Catégorie ajouter avec succès.';
                    // Update the list of categories.
                    let content = `<li id="item-${id}" class="list-group-item d-flex justify-content-between cat-item align-items-center">
                        <span class="text-truncate">
                            ${id} <i class="feather icon-minus"></i> ${intitule}
                        </span>
                        <div class="options d-flex">
                            <span class="cursor-pointer edit" data-id="${id}" data-intitule="${intitule}"><i class="feather icon-edit-2"></i></span>
                            <span class="cursor-pointer delete" data-id="${id}"><i class="feather icon-trash"></i></span>
                        </div>
                    </li>`;
                    $("#cat_courrier_id").append(content);
                }

                toastr.success(title, '', { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e4})


            }

            manager_cat_list();

            dismiss_block(progress);
        }).catch(reason => {
            dismiss_block(progress);
            toastr.error('😥' + reason, 'Erreur', { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e4})
        });

    });
}

/**
 * Fonction qui permet de gérer la liste des categories.
 */
function manager_cat_list () {

    // DELETION
    $('#cat_courrier_id .delete').each((i, elt)=> {
        $(elt).click(()=>{
            let id = $(elt).attr("data-id");
          let action = '/root/categories/delete/' + id; // Pour les root (super admin). 

            let progress = set_progress_block($('#item-'+id));

            axios.get(HOST_BACKEND + action).then(response => {
                let status = response.status;

                // If 202
              if (status == 202) {
                toastr.warning('😥' + data, '', { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e4})
              }

                // If 200
                if(status == 200){
                    toastr.success('Catégorie supprimée avec succès.', '', { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e4})

                    $("#item-" + id).slideUp(100, ()=>{
                        $("#item-" + id).remove();
                    });
                }

                dismiss_block(progress);
            }).catch(reason=> {
              dismiss_block(progress);
              
              toastr.error('😥' + reason, 'Erreur', { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e4})
            })
        });
    })

    // EDITION
    $('#cat_courrier_id .edit').each((i, elt) => {
        $(elt).click(()=>{
            $("#form-back").show();
            let id = $(elt).attr("data-id");
            let intitule = $(elt).attr("data-intitule");
            let form = $('#cat_form');
          form.attr('action', '/root/categories/update/' + id);
          
            $('#category').val(intitule);
            $('#form-title').html('Modification d\'une categorie')
            $('#cat_form button').html('Mettre à jour');
        });
    })

    // FROM BACK
    $("#form-back").click(function(){

        $(this).hide();

        let form = $('#cat_form');

        form.attr('action', '/root/categories/store');
        $('#category').val('');
        $('#form-title').html('Formulaire d\'ajout d\'une nouvelle categorie')
        $('#cat_form button').html('Valider');
    })
}

(function (window, document, $) {
    $(document).ready(() => {

        // Category form manager.
        manager_cat_from();

        $("#form-back").hide();
        // Category list manager.
        manager_cat_list();

    });
})(window, document, jQuery);  