/*=========================================================================================
  File Name: location-manager.js
  Description: Fichier qui permet de gérer les locations de la plate forme (pour les agents.)
  ----------------------------------------------------------------------------------------
  Author: RoanldTchuekou
  Author email: ronaldtchuekou@gmail.com
==========================================================================================*/

/**
 * Fonction qui permet de gérer le formulaire d'ajout/modification de categorie de courriers.
 */
 function manager_location_from(){
    const form = $("#location_form");

    $(form).submit((e)=>{
        e.preventDefault();
        const location_input = $("#location_form #location");
        let location = location_input.val(),
            action = e.target.getAttribute("action");

        let progress = set_progress_block(
            document.querySelector('#location-form-content')
        );

        axios.post(HOST_BACKEND + action, {
            location: location,
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
              let location = data.record;
                let id = location.id, intitule = location.intitule, edit = location.edit, title = '';


                if(edit){ // Pour le mode mise à jour.
                    title = 'location mis à jour avec succès.';
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
                    title = 'location ajouter avec succès.';
                    // Update the list of locations.
                    let content = `<li id="item-${id}" class="list-group-item d-flex justify-content-between cat-item align-items-center">
                        <span class="text-truncate">
                            ${id} <i class="feather icon-minus"></i> ${intitule}
                        </span>
                        <div class="options d-flex">
                            <span class="cursor-pointer edit" data-id="${id}" data-intitule="${intitule}"><i class="feather icon-edit-2"></i></span>
                            <span class="cursor-pointer delete" data-id="${id}"><i class="feather icon-trash"></i></span>
                        </div>
                    </li>`;
                    $("#location_id").append(content);
                }

                toastr.success(title, '', { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e4})


            }

            manager_location_list();

            dismiss_block(progress);
        }).catch(reason => {
            dismiss_block(progress);
            toastr.error('😥' + reason, 'Erreur', { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e4})
        });

    });
}

/**
 * Fonction qui permet de gérer la liste des locations.
 */
function manager_location_list() {
    
    var role = $('#location_id').data('role')

    // DELETION
    $('#location_id .delete').each((i, elt)=> {
        $(elt).click(()=>{
            let id = $(elt).data("id");
          let action = '/' + role + '/localisations/delete/' + id; // Pour les root (super admin). 

            let progress = set_progress_block($('#item-'+id));

            axios.get(HOST_BACKEND + action).then(response => {
                let status = response.status;

                // If 202
                if (status == 202) {
                    toastr.warning('😥' + data, '', { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e4})
                }

                // If 200
                if(status == 200){
                    toastr.success('localisation supprimée avec succès.', '', { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e4})

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
    $('#location_id .edit').each((i, elt) => {
        $(elt).click(()=>{
            $("#form-back").show();
            let id = $(elt).attr("data-id");
            let intitule = $(elt).attr("data-intitule");
            let form = $('#location_form');
            form.attr('action', '/' + role + '/localisations/update/' + id);
            $('#location').val(intitule);
            $('#form-title').html('Modification d\'un localisation');
            $('#location_form button').html('Mettre à jour');
        });
    })

    // FROM BACK
    $("#form-back").click(function(){

        $(this).hide();

        let form = $('#location_form');

        form.attr('action', '/' + role + '/localisations/store');
        $('#location').val('');
        $('#form-title').html('Formulaire d\'ajout d\'un nouveau localisation')
        $('#location_form button').html('Valider');
    })
}

(function (window, document, $) {
    $(document).ready(() => {
        // Category form manager.
        manager_location_from();

        $("#form-back").hide();
        // Category list manager.
        manager_location_list();

    });
})(window, document, jQuery);  