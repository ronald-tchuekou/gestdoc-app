/*=========================================================================================
  File Name: app.js
  Description: Template related app JS.
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: RoanldTchuekou
  Author email: ronaldtchuekou@gmail.com
==========================================================================================*/

var config = {
  headers: {'X-My-Custom-Header': 'Header-Value'}
};

/**
 * Fonction qui permet d'injecter les progress dans des blocks.
 * @param {string} _id_elt identifiant de l'élément.
 */
function set_progress_block(_id_elt) {
  return $(_id_elt).block({
    message: '<div class="spinner-border text-primary" role="status"></div>',
    timeout: 0,
    css: {
      backgroundColor: 'transparent',
      border: '0'
    },
    overlayCSS: {
      backgroundColor: '#fff',
      opacity: 0.8,
      borderRadius:'4px', 
    }
  });
}

/**
 * Fonction qui permet de masquer la progression.
 * @param {Element} elt Element de sellection.
 */
function dismiss_block(elt) {
  elt.block({ message: '', timeout: 1 });
}


/**************************
 * Manage de filter of the admin agent table.
 */
function admin_agent_filter() {
  let filter_service = $('#filter-agent-service');
  let filter_last_date_marge = $('#filter-agent-last_date_marge');
  let filter_account_status = $('#filter-agent-account_status');

  // HandleChange.
  filter_service.on('change', (elt) => {
    let value = elt.target.value;
    toastr.info('Filtrage par servive : ' + value, 'Module de section',
      { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3})
  });

  filter_last_date_marge.on('change', (elt) => {
    let value = elt.target.value;
    toastr.info('Filtrage par marge de connexion : ' + value, 'Module de section',
      { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3})

  });

  filter_account_status.on('change', (elt) => {
    let value = elt.target.value;
    toastr.info('Filtrage par status du compte : ' + value, 'Module de section',
      { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3})
  });

}

(function (window, document, $) {
  $(document).ready(() => {

    // Set the listener.
    admin_agent_filter();

    // Manage the back event listener.
    $('.backPerss').each((i, elt) => {
      $(elt).on('click', () => {
        history.back();
      });
    });

    $('#alertSuccessDialog').modal('show'); // Show the success modal.

    var row;
    
    $('.assigner_btn').each((i, elt) => {
      $(elt).on('click', function () {

        // Init all..
        $('#agent_id').val('');
        $('#tache').val('');

        let courier = $(this).attr('data-courier').split('/'),
          courier_id = courier[0],
          categorie = courier[1],
          nbPiece = courier[2];
        row = elt;
        $('#courier_id').val(courier_id);
        $('#courier_nb').val(nbPiece);
        $('#courier_cat').val(categorie);
      });
    });

    // Assign the docs.
    $('#assign-form').submit(function (e) {
      e.preventDefault();

      let action = e.target.getAttribute('action'),
        courier_id = $('#courier_id').val(),
        agent_id = $('#agent_id').val(),
        tache = $('#tache').val();
      
      if (agent_id == '') { // Check the agent.
        toastr.warning('Veuillez selectionner un agent chez qui assigner le dossier.', 'Avertissement',
          { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3});
      } else if (tache == '') { // Check the task.
        toastr.warning('Veuillez renseigner la tâche à faire sur le dossier.', 'Avertissement',
          { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3});
      } else { // Submit the data and get the response.
        data = {
          'courier_id': parseInt(courier_id),
          'agent_id': parseInt(agent_id),
          'tache': tache,
        };

        let d = set_progress_block('#assign-modal-content');

        axios.post(HOST_BACKEND + action, data, config).then(response => {

          if (response.status != 200) {
            toastr.warning(response.data, 'Averitssement',
            { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3});
          } else {
            $(row).parent().parent().parent().parent().remove();
            toastr.success('Dossier assigné avec succès.', 'Succès',
            { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3});
          }
          dismiss_block(d);
        }).catch(reason => {
          toastr.error('Error : ' + reason, 'Error');
          dismiss_block(d);
        });
      }
    });

    // Reject form.
    $('.reject_btn').each((i, elt) => {
      $(elt).on('click', function () {
        $('#reason').val('');
        let courier = $(this).attr('data-courier').split('/'),
          courier_id = courier[0],
          reject_mode = courier[1];
          row = elt;
        
        let title = $('#title-reject-modal'),
          label = $('#label-reject-modal'),
          input_reason = $('#reason'),
          btn_submit = $('#btn-reject-doc');

        if (reject_mode === 'modify') {
          title.text('Retour pour modification.');
          label.text('Indiquer la raison pour la qelle vous retournez le dossier pour modification.')
        } else {
          title.text('Rejet du dossier.');
          label.text('Indiquer la raison pour la qelle vous rejetez le dossier.')
        }

        // Listen the soumition.
        btn_submit.on('click', function (e) {
          let reason = input_reason.val();
          if (reason == '') {
            input_reason.addClass('is-invalid');
            return;
          } else {
            input_reason.removeClass('is-invalid');

            let modal = set_progress_block('#confirm-reject-modal-content');
            
            axios.get(HOST_BACKEND + '/admin/couriers/' + courier_id + '/' + reason + '/' + reject_mode)
              .then(response => {
                if (response.status != 200) {
                  toastr.error(response.data, 'Erreur',
                     { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3});
                } else {
                  $(row).parent().parent().parent().parent().remove();
                  if (reject_mode === 'modify') {
                    toastr.info('Dossier rejeté pour une modification.', 'Succès',
                      { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3});
                  } else {
                    toastr.info('Dossier rejeté, pas de retour possible.', 'Succès',
                      { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3})
                  }
                }
                dismiss_block(modal);
              }).catch(reason => {
                toastr.error('Error : ' + reason, 'Error');
                dismiss_block(modal);
              });
          }
         

        });
        
      });
    });

    // Validate a courier.
    $('.validate-courier').each((i, elt) => {
      $(elt).on('click', function () {
        let courier_id = $(this).attr('data-courier');
        row = elt;

        let loader = set_progress_block($(elt));
       
        axios.get(HOST_BACKEND + '/admin/couriers/validate/' + courier_id)
          .then(response => {
            if (response.status == 200) {
              $(row).parent().parent().parent().parent().remove();
              toastr.success('Dossier validé avec succès.', 'Message de succès',
                { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3});
            } else {
              toastr.warning('Une erreur s\'est produite. ' + response.data, 'Message d\'erreur',
               { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3});
            }
            dismiss_block(loader);
          }).catch(reason => {
            toastr.error('Error : ' + reason, 'Error');
            dismiss_block(loader);
          });
      });
    });

    // Finish a courier.
    $('.btn-traitement-finish').each((i, elt) => {
      $(elt).on('click', function (e) {
        
        row = elt;
        let courier_id = $(this).attr('data-courier')
        let bo = set_progress_block(elt);

        axios.get(HOST_BACKEND + '/agent/couriers/' + courier_id + '/finish')
          .then(response => {
            if (response.status == 200) {
              $(row).parent().parent().remove();
              toastr.success('Dossier Traité avec succès.', 'Message de succès',
                { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3});
            } else {
              toastr.error('Une erreur s\'est produite. ' + response.data, 'Message d\'erreur',
               { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3});
            }
            dismiss_block(bo);
          }).catch(reason => {
            toastr.error(reason, 'Error');
            dismiss_block(bo);
          });
        
      });
    });

  });
})(window, document, jQuery)