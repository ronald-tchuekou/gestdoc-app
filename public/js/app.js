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

const notify_timeOut = 3e4;

// Initialisation of service workers.
// function initializeService() {
//   if('serviceWorker' in navigator) {
//       // Supported 😍
//       toastr.info('Les services workers sont supporté par ce navigateur. 😍','Information',
//       { showMethod: "slideDown", hideMethod: "slideUp", timeOut: notify_timeOut})
//   } else {
//       // Not supported 😥
//       toastr.warning('Les services workers ne sont pas supporté par ce navigateur. 😥','Information',
//       { showMethod: "slideDown", hideMethod: "slideUp", timeOut: notify_timeOut})
//   }
// }

// Fonction qui afficher les pourcentages des courriers.
function setChartAnalyst(_data) {
  let valide = _data.valide / _data.total,
  traite = _data.traite / _data.total,
  reject = _data.reject / _data.total;

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
    series: [+valide.toFixed(2), +traite.toFixed(2), +reject.toFixed(2)],
    labels: ['Validés', 'Traités', 'Rejetés'],

  }
}

// Fonction qui retourne le diagramme qui analyse les courriers.
function renderAnalystCourrierChart(_from) {

  axios.get(HOST_BACKEND + '/statistiquesCourriers/' + _from).then(response => {

    if (response.status == 200) {

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
       { showMethod: "slideDown", hideMethod: "slideUp", timeOut: notify_timeOut});
    }

  }).catch(reason => {
    toastr.error('😥' + reason,'Message d\'erreur',
    { showMethod: "slideDown", hideMethod: "slideUp", timeOut: notify_timeOut})
  });

}

// Customer users Chart
// -----------------------------
function setUserAnalystChar(_data){

  return  customerChartoptions = {
    chart: {
      type: 'pie',
      height: 360,
      dropShadow: {
        enabled: false,
        blur: 5,
        left: 1,
        top: 1,
        opacity: 0.2
      },
      toolbar: {
        show: false
      }
    },
    labels: ['Agents Actifs', 'Agents Non actifs', 'Agents Supprimés'],
    series: [_data.active_users, _data.non_active_users, _data.delete_users],
    dataLabels: {
      enabled: false
    },
    legend: { show: false },
    stroke: {
      width: 5
    },
    colors: [$primary, $warning, $danger],
    fill: {
      type: 'gradient',
      gradient: {
        gradientToColors: [$primary_light, $warning_light, $danger_light]
      }
    }
  };

}

function renderAnalystUserChart() {

  axios.get(HOST_BACKEND + '/statistiquesAgents').then(response => {

    if (response.status == 200) {

      let data = response.data.record;

      $('#total_active_users').html(data.active_users);
      $('#total_non_active_users').html(data.non_active_users);
      $('#total_delete_users').html(data.delete_users);

      let customerChartoptions = setUserAnalystChar(response.data.record);

      var customerChart = new ApexCharts(
        document.querySelector("#users-chart"),
        customerChartoptions
      );

      customerChart.render();

    } else {
      toastr.error('Une erreur s\'est produite. ' + response.data, 'Message d\'erreur',
       { showMethod: "slideDown", hideMethod: "slideUp", timeOut: notify_timeOut});
    }

  }).catch(reason => {
    toastr.error('😥' + reason,'Message d\'erreur',
    { showMethod: "slideDown", hideMethod: "slideUp", timeOut: notify_timeOut})
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
      { showMethod: "slideDown", hideMethod: "slideUp", timeOut: notify_timeOut})
  });

  filter_last_date_marge.on('change', (elt) => {
    let value = elt.target.value;
    toastr.info('Filtrage par marge de connexion : ' + value, 'Module de section',
      { showMethod: "slideDown", hideMethod: "slideUp", timeOut: notify_timeOut})

  });

  filter_account_status.on('change', (elt) => {
    let value = elt.target.value;
    toastr.info('Filtrage par status du compte : ' + value, 'Module de section',
      { showMethod: "slideDown", hideMethod: "slideUp", timeOut: notify_timeOut})
  });

}

(function (window, document, $) {
  $(document).ready(() => {

    // init the service.
    //initializeService();

    $('.badge-pill.noti').hide();

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
          { showMethod: "slideDown", hideMethod: "slideUp", timeOut: notify_timeOut });
      } else if (tache == '') { // Check the task.
        toastr.warning('Veuillez renseigner la tâche à faire sur le dossier.', 'Avertissement',
          { showMethod: "slideDown", hideMethod: "slideUp", timeOut: notify_timeOut });
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
              { showMethod: "slideDown", hideMethod: "slideUp", timeOut: notify_timeOut });
          } else {
            $(row).parent().parent().parent().parent().remove();
            $("#init_courier_table_admin").DataTable();
            toastr.success('Dossier assigné avec succès.', 'Succès',
              { showMethod: "slideDown", hideMethod: "slideUp", timeOut: notify_timeOut });
          }
          dismiss_block(d);
        }).catch(reason => {
          toastr.error('Error : ' + reason, 'Error');
          dismiss_block(d);
        });
      }
    });

    // Observation about courier.
    $('.observation_btn').each((i, elt) => {
      $(elt).on('click', function () {
        $('#observation').val('')
        let courier_data = $(this).data('courier').split('/'),
          courier_id = courier_data[0],
          user_id = courier_data[1],
          user_role = courier_data[2]
        $('#btn-observation-doc').on('click', function () {
          let observation = $('#observation').val();
          if (observation == '') {
            $('#observation').addClass('is-invalid');
            return;
          } else {
            $('#observation').removeClass('is-invalid');

            let modal = set_progress_block('#observation-modal-content');

            axios.post(`${HOST_BACKEND}/${user_role}/courriers/add-observation`, {
              user_id: user_id,
              courier_id: courier_id,
              observation: observation,
            })
              .then(response => {
                if (response.status != 200) {
                  toastr.warning(response.data, 'Erreur',
                    { showMethod: "slideDown", hideMethod: "slideUp", timeOut: notify_timeOut });
                } else {
                  toastr.success('Observation ajouté sur le dossier.', 'Succès',
                    { showMethod: "slideDown", hideMethod: "slideUp", timeOut: notify_timeOut });
                }
                dismiss_block(modal);
                $('#observation-modal').modal('hide');
              }).catch(reason => {
                toastr.error(reason, 'Error');
                dismiss_block(modal);
              });
          }
        })
      })
    })

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
                    { showMethod: "slideDown", hideMethod: "slideUp", timeOut: notify_timeOut });
                } else {
                  $(row).parent().parent().parent().parent().remove();
                  $("#init_courier_table_admin").DataTable();
                  if (reject_mode === 'modify') {
                    toastr.info('Dossier rejeté pour une modification.', 'Succès',
                      { showMethod: "slideDown", hideMethod: "slideUp", timeOut: notify_timeOut });
                  } else {
                    toastr.info('Dossier rejeté, pas de retour possible.', 'Succès',
                      { showMethod: "slideDown", hideMethod: "slideUp", timeOut: notify_timeOut })
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
              $("#finish_courier_table_admin").DataTable();
              update_badge_count("#badge-finish", -1);
              toastr.success('Dossier validé avec succès.', 'Message de succès',
                { showMethod: "slideDown", hideMethod: "slideUp", timeOut: notify_timeOut });
            } else {
              toastr.warning('Une erreur s\'est produite. ' + response.data, 'Message d\'erreur',
                { showMethod: "slideDown", hideMethod: "slideUp", timeOut: notify_timeOut });
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
              $("#finish_courier_table_agent").DataTable();
              toastr.success('Dossier Traité avec succès.', 'Message de succès',
                { showMethod: "slideDown", hideMethod: "slideUp", timeOut: notify_timeOut });
            } else {
              toastr.error('Une erreur s\'est produite. ' + response.data, 'Message d\'erreur',
                { showMethod: "slideDown", hideMethod: "slideUp", timeOut: notify_timeOut });
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

    renderAnalystCourrierChart("none");

    $('.courrier-date_intervalle').each(function (i, elt) {
      $(elt).click(function () {
        let content = $(this).attr('data-content');
        $('#dropdownItem2').html($(this).html());
        let date = new Date();
        if (content == "28d") { // Il y'a 28 jours.
          date.setDate(date.getDate() - 28);
        } else if (content == "1m") { // Il y'a 1 moi.
          date.setDate(date.getDate() - 31);
        } else { // Il y'a 1 an.
          date.setDate(date.getDate() - 365);
        }
        const ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(date);
        const mo = new Intl.DateTimeFormat('en', { month: 'numeric' }).format(date);
        const dm = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(date);
        let from = `${dm}-${mo}-${ye}`;

        renderAnalystCourrierChart(from);
      });
    });

    // courrier Order Chart ends //


    // users Order Chart starts
    // -----------------------------

    renderAnalystUserChart();

    // users Order Chart ends //


  });
})(window, document, jQuery);


$(document).ready(function () {
  
  let options = {
    "responsive": true,
    "autoWidth": false,
    "columnDefs": [
      { "width": "35%", "targets": '_all' }
    ]
  };
  
  $("#init_courier_table_admin").DataTable(options);
    $("#finish_courier_table_admin").DataTable(options);
    $("#modify_courier_table_admin").DataTable(options);
    $("#agents_table_admin").DataTable(options);
    $("#adjoints_table_root").DataTable(options);
    $("#finish_courier_table_agent").DataTable(options);
    $("#init_courier_table_accueil").DataTable(options);
    $("#reject_courier_table_accueil").DataTable(options);
    $("#valide_courier_table_accueil").DataTable(options);
    $("#modify_courier_table_accueil").DataTable(options);
    $('#account_table_accueil').DataTable(options);
    $('#account_table_root').DataTable(options);
} );

/**
 * Fonction qui permet de mettre à jour le nombre contenu dans un badge.
 * @param {String} target_id éléments sélectionné.
 * @param {Number} value valeur à ajouter sur la valeur courante.
 */
function update_badge_count(target_id, value) {
  let target = $(target_id),
    count = parseInt(target.html());
  target.html(count + (value));
}