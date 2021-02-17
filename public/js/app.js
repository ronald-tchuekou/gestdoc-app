/*=========================================================================================
  File Name: app.js
  Description: Template related app JS.
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: RoanldTchuekou
  Author email: ronaldtchuekou@gmail.com
==========================================================================================*/

var $primary = '#7367F0';
var $danger = '#EA5455';
var $warning = '#FF9F43';
var $info = '#0DCCE1';
var $primary_light = '#8F80F9';
var $warning_light = '#FFC085';
var $danger_light = '#f29292';
var $info_light = '#1edec5';
var $strok_color = '#b9c3cd';
var $label_color = '#e7eef7';
var $white = '#fff';


// Initialisation of service workers.
function initializeService() {
  if('serviceWorker' in navigator) {
      // Supported 😍
      toastr.info('Les services workers sont supporté par ce navigateur. 😍','Information', 
      { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3})
  } else {
      // Not supported 😥
      toastr.warning('Les services workers ne sont pas supporté par ce navigateur. 😥','Information', 
      { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3})
  }
}

// Fonction qui afficher les pourcentages des courriers.
function setChartAnalyst(_data) {
  return {
    chart: {
      height: 325,
      type: 'radialBar',
    },
    colors: [$primary, $warning, $danger],
    fill: {
      type: 'gradient',
      gradient: {
        // enabled: true,
        shade: 'dark',
        type: 'vertical',
        shadeIntensity: 0.5,
        gradientToColors: [$primary_light, $warning_light, $danger_light],
        inverseColors: false,
        opacityFrom: 1,
        opacityTo: 1,
        stops: [0, 100]
      },
    },
    stroke: {
      lineCap: 'round'
    },
    plotOptions: {
      radialBar: {
        size: 165,
        hollow: {
          size: '20%'
        },
        track: {
          strokeWidth: '100%',
          margin: 15,
        },
        dataLabels: {
          name: {
            fontSize: '18px',
          },
          value: {
            fontSize: '16px',
          },
          total: {
            show: true,
            label: 'Total',
            formatter: function (w) {
              return _data.total;
            },
          }
        }
      }
    },
    series: [_data.valide / _data.total, _data.traite / _data.total, _data.reject / _data.total],
    labels: ['Validé', 'Traité', 'Rejeté'],

  }
}

// Fonction qui retourne le diagramme qui analyse les courriers.
function renderTheContrent(_from) {
  axios.get(HOST_BACKEND + '/statistiquesCourriers/' + _from).then(response => {

    if (response.status == 200) {

      console.log(response.data);
      let data = response.data.record;

      $('#total_valide_courrier').html(data.valide);
      $('#total_traite_courrier').html(data.traite);
      $('#total_reject_courrier').html(data.reject);

      let courrierChartoptions = setChartAnalyst(response.data.record);

      var courrierChart = new ApexCharts(
        document.querySelector("#courrier-order-chart"),
        courrierChartoptions
      );
    
      courrierChart.render();

    } else {
      toastr.error('Une erreur s\'est produite. ' + response.data, 'Message d\'erreur',
       { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3});
    }

  }).catch(reason => {
    toastr.error('😥' + reason,'Message d\'erreur', 
    { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3})
  });

}

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

    // init the service.
    initializeService();

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
                  toastr.warning(response.data, 'Erreur',
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
                toastr.error(reason, 'Error');
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



  // courrier Order Chart starts
  // -----------------------------
    
    renderTheContrent("none");

    $('.courrier-date_intervalle').each(function (i, elt) {
      $(elt).click(function () {
        let content = $(this).attr('data-content');
        $('#dropdownItem2').html($(this).html());
        let date = new Date();
        if(content == "28d"){ // Il y'a 28 jours.
          date.setDate(date.getDate() - 28);
        }else if(content == "1m"){ // Il y'a 1 moi.
          date.setDate(date.getDate() - 31);
        }else{ // Il y'a 1 an.
          date.setDate(date.getDate() - 365);
        }
        const ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(date);
        const mo = new Intl.DateTimeFormat('en', { month: 'numeric' }).format(date);
        const dm = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(date);
        let from = `${dm}-${mo}-${ye}`;
        
        renderTheContrent(from);
      });
    });
    
  // courrier Order Chart ends //


  });
})(window, document, jQuery)