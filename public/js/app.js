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
                toastr.warning(data, '', { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3})
            }

            // If 202
            if(status == 202){
                toastr.error('😥' + data, '', { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3})
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

                toastr.success(title, '', { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3})


            }

            console.log(response);

            manager_cat_list();

            dismiss_block(progress);
        }).catch(reason => {
            dismiss_block(progress);
            toastr.error('😥' + reason, 'Erreur', { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3})

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
            let action = '/admin/categories/delete/' + id;

            let progress = set_progress_block($('#item-'+id));

            axios.get(HOST_BACKEND + action).then(response => {
                let status = response.status;

                // If 202
                if(status == 202){
                    toastr.error('😥' + data, '', { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3})
                }

                // If 200
                if(status == 200){
                    toastr.success('Catégorie supprimée avec succès.', '', { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3})

                    $("#item-" + id).slideUp(100, ()=>{
                        $("#item-" + id).remove();
                    });
                }

                dismiss_block(progress);
            }).catch(reason=> {
                dismiss_block(progress);
                toastr.error('😥' + reason, 'Erreur', { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3})
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

            console.log(id, intitule, form);

            form.attr('action', '/admin/categories/update/' + id);
            $('#category').val(intitule);
            $('#form-title').html('Modification d\'une categorie')
            $('#cat_form button').html('Mettre à jour');
        });
    })

    // FROM BACK
    $("#form-back").click(function(){

        $(this).hide();

        let form = $('#cat_form');

        form.attr('action', '/admin/categories/store');
        $('#category').val('');
        $('#form-title').html('Formulaire d\'ajout d\'une nouvelle categorie')
        $('#cat_form button').html('Valider');
    })
}

// Initialisation of service workers.
// function initializeService() {
//   if('serviceWorker' in navigator) {
//       // Supported 😍
//       toastr.info('Les services workers sont supporté par ce navigateur. 😍','Information',
//       { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3})
//   } else {
//       // Not supported 😥
//       toastr.warning('Les services workers ne sont pas supporté par ce navigateur. 😥','Information',
//       { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3})
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
       { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3});
    }

  }).catch(reason => {
    toastr.error('😥' + reason,'Message d\'erreur',
    { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3})
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
    //initializeService();



    // Category form manager.
    manager_cat_from();

    $("#form-back").hide();
    // Category list manager.
    manager_cat_list();

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
          { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3 });
      } else if (tache == '') { // Check the task.
        toastr.warning('Veuillez renseigner la tâche à faire sur le dossier.', 'Avertissement',
          { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3 });
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
              { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3 });
          } else {
            $(row).parent().parent().parent().parent().remove();
            toastr.success('Dossier assigné avec succès.', 'Succès',
              { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3 });
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
                    { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3 });
                } else {
                  $(row).parent().parent().parent().parent().remove();
                  if (reject_mode === 'modify') {
                    toastr.info('Dossier rejeté pour une modification.', 'Succès',
                      { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3 });
                  } else {
                    toastr.info('Dossier rejeté, pas de retour possible.', 'Succès',
                      { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3 })
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
                { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3 });
            } else {
              toastr.warning('Une erreur s\'est produite. ' + response.data, 'Message d\'erreur',
                { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3 });
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
                { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3 });
            } else {
              toastr.error('Une erreur s\'est produite. ' + response.data, 'Message d\'erreur',
                { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3 });
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


$(document).ready(function() {
    $("#init_courier_table_admin").DataTable();
    $("#finish_courier_table_admin").DataTable();
    $("#modify_courier_table_admin").DataTable();
    $("#agents_table_admin").DataTable();
    $("#finish_courier_table_agent").DataTable();
    $("#init_courier_table_accueil").DataTable();
    $("#reject_courier_table_accueil").DataTable();
    $("#valide_courier_table_accueil").DataTable();
    $("#modify_courier_table_accueil").DataTable();
} );
