/**
 * NotifyEventListener.js
 *
 * Fichier qui permet de faire des notifications au utilisateurs.
 *
 * @author Ronald Tchuekou.
 * @email ronaldtchuekou@gmail.com
 */

/**
 * Fonction qui permet d'envoyer une notification.
 */
var setNotification = (data) => {
    let badge = $('.badge-pill.noti');
    let notify_list = $('#notify-list');
    let notify_content = `<hr/>
    <a class="d-flex" href="">
        <div class="media d-flex align-items-start">
            <div class="media-left">
                <div class="avatar">
                    <img src="${data.sender.profile}" alt="avatar" width="32" height="32">
                </div>
            </div>
            <div class="media-body">
                <p class="media-heading">
                    <span class="font-weight-bolder">${data.message.title}</span>
                    <small class="text-danger">${data.sender.name} ${data.sender.surname}</small>
                </p>
                <small class="text-dark">${data.message.content}.</small>
            </div>
        </div>
    </a>`;

    toastr.info(`${data.message.content}`, data.message.title,
    { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3 });

    badge.show();
    let notify_count = parseInt($(badge[0]).html());

    $(badge).each((i, elt) => {
        $(elt).html(notify_count + 1);
    });

    $(notify_list).append(notify_content);

}

/**
 * Ecouter les changements pour un compte accueil. (Courriers à modifés, Courriers rejetés, Courriers validés.)
 */
var accuiel_listener = (etat, data) => {
    if (etat == 'modify')
        setModifyCourrier_accueil(data);
    else if (etat == 'reject')
        setRejectCourrier_accueil(data);
    else if (etat == 'validate')
        setValidateCourrier_accueil(data);
}

/**
 * Ecouter les changements pour les agent. (Les courriers assignés.)
 */
var agent_listener = (data, tache) => {
    let row_count = document.querySelectorAll('#agent-finish tr[role="row"]').length + 1;
    let content = `<tr role="row" class="odd hover" id="row-${row_count}">
                    <td>
                        ${data.id}
                    </td>
                    <td class="sorting_1 ellipsize" style="max-width: 250px;">${data.objet}</td>
                    <td><span>${tache}</span></td>
                    <td>${update}</td>
                    <td>
                        <button data-courier="${data.id}" class="btn btn-secondary btn-sm btn-traitement-finish">Terminer</button>
                    </td>
                </tr>`;
    $('#agent-finish').append(content);
}

/**
 * Ecouter les changements pour les admin. (Courriers modifié, Courriers Traité, Courriers Initialisés)
 */
var admin_listener = (data, action, role) => {
    if(action == 'init')
        setInitCourrier_admin(data, role);
    else if (action == 'modify')
        setModifyCourrier_admin(data, role);
    else if(action == 'finish')
        setFinishCourrier_admin(data, role);
}

var setModifyCourrier_accueil = (data) => {

    let row_count = document.querySelectorAll('#accueil-modify tr[role="row"]').length + 1;
    let content = `<tr role="row" class="odd hover" id="row-${row_count}">
                    <td>${data.id}</td>
                    <td class="sorting_1 ellipsize" style="max-width: 250px;">${data.objet}</td>
                    <td><span class="text-truncate align-middle text-nowrap">${data.motif}</span></td>
                    <td>${data.date}</td>
                    <td>
                        <a href="/accueil/couriers/${data.id}/modify" class="btn btn-warning btn-sm">Modifier</a>
                    </td>
                </tr>`;

    $('#accueil-modify').append(content);
}

var setRejectCourrier_accueil = (role, data) => {

    let row_count = document.querySelectorAll('#accueil-reject tr[role="row"]').length + 1;
    let content = `<tr role="row" class="odd hover" id="row-${row_count}">
                    <td>
                        ${data.id}
                    </td>
                    <td class="sorting_1 ellipsize" style="max-width: 250px;">${data.objet}</td>
                    <td>${data.motif}</td>
                    <td>${data.date}</td>
                    <td>
                        <div class="d-flex justify-content-left align-items-center">
                            <div class="d-flex flex-column">
                                <a href="javascript:void()" class="user_name text-truncate">
                                    <span class="font-weight-bold">${data.name} ${data.surname}</span>
                                </a>
                                <small class="emp_post text-muted">${data.phone}</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="/${'accueil'}/courier-details/${data.id}" class="btn btn-info btn-sm">
                            <i class="feather icon-file-text" style="font-size: 1rem;"></i>
                            &nbsp;&nbsp;&nbsp;Details
                        </a>
                    </td>
                </tr>`;

    $('#accueil-reject').append(content);
}

var setValidateCourrier_accueil = (data) => {
    let row_count = document.querySelectorAll('#accueil-valide tr[role="row"]').length + 1;
    let content = `<tr role="row" class="odd hover" id="row-${row_count}">
                        <td>
                            ${data.id}
                        </td>
                        <td class="sorting_1 ellipsize" style="max-width: 250px;">${data.objet}</td>
                        <td>${data.date}</td>
                        <td>${data.prestataire}</td>
                        <td>
                            <div class="d-flex justify-content-left align-items-center">
                                <div class="d-flex flex-column">
                                    <a href="javascript:void()" class="user_name text-truncate">
                                        <span class="font-weight-bold">${data.name} ${data.surname}</span>
                                    </a>
                                    <small class="emp_post text-muted">${data.phone}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="/${'accueil'}/courier-details/${data.id}" class="btn btn-info btn-sm">
                                <i class="feather icon-file-text" style="font-size: 1rem;"></i>
                                &nbsp;&nbsp;&nbsp;Details
                            </a>
                        </td>
                    </tr>`;

    $('#accueil-valide').append(content);
}

var setInitCourrier_admin = (data, role) => {

    let row_count = document.querySelectorAll('#admin-initial-courriers tr[role="row"]').length + 1;
    let content = `
        <tr role="row" class="odd hover" id="row-${row_count}">
            <td>${data.id} </td>
            <td>
                <div class="d-flex justify-content-left align-items-center">
                    <div class="d-flex flex-column">
                        <a href="javascript:void()" class="user_name text-truncate">
                            <span class="font-weight-bold">${data.nom} ${data.prenom}</span>
                        </a>
                        <small class="emp_post text-muted">${data.telephone}</small>
                    </div>
                </div>
            </td>
            <td class="sorting_1 ellipsize" style="max-width: 250px;">${data.objet}</td>
            <td><span class="text-truncate align-middle text-nowrap">${data.nbPiece}</span></td>
            <td>${data.prestataire}</td>
            <td><span class="badge badge-pill badge-light-info" text-capitalized="">${data.etat}</span></td>
            <td>${data.date}</td>
            <td>
                <div class="btn-group">
                    <button class="btn btn-sm hide-arrow" data-toggle="dropdown">
                        <i class="feather icon-more-vertical font-medium-3 text-muted cursor-pointer"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- <a href="/${role}/couriers/${data.id}" id="type-success" class="dropdown-item" style="padding: 7px 9px;"> -->
                        <a href="/${role}/courier-details/${data.id}" class="dropdown-item" style="padding: 7px 9px;">
                            <i class="feather icon-file-text" style="font-size: 1.5rem;"></i>
                            &nbsp;&nbsp;&nbsp;Details
                        </a>
                        <a href="javascript:void()" class="dropdown-item assigner_btn" style="padding: 7px 9px;"
                            tabindex="0"
                            aria-controls="courier_table_admin"
                            type="button"
                            data-courier="${data.id}/${data.categorie}/${data.nbPiece}/${row_count}"
                            data-toggle="modal"
                            data-target="#assign-doc-modal">

                            <i class="feather icon-send" style="font-size: 1.5rem;"></i>
                            &nbsp;&nbsp;&nbsp;Assigner
                        </a>
                        <a href="javascript:void()" class="dropdown-item reject_btn" style="padding: 7px 9px;"
                            tabindex="0"
                            aria-controls="courier_table_admin"
                            type="button"
                            data-courier="${data.id}/reject/${row_count}"
                            data-toggle="modal"
                            data-target="#confirm-reject-modal">

                            <i class="feather icon-x-circle" style="font-size: 1.5rem;"></i>
                            &nbsp;&nbsp;&nbsp;Rejeter
                        </a>
                        <a href="javascript:void()" class="dropdown-item reject_btn" style="padding: 7px 9px;"
                            tabindex="0"
                            aria-controls="courier_table_admin"
                            type="button"
                            data-courier="${data.id}/modify/${row_count}"
                            data-toggle="modal"
                            data-target="#confirm-reject-modal">

                            <i class="feather icon-edit-2" style="font-size: 1.5rem;"></i>
                            &nbsp;&nbsp;&nbsp;Modifier
                        </a>
                    </div>
                </div>
            </td>
        </tr>`;

    $('#admin-initial-courriers').append(content);

    $("#init_courier_table_admin").DataTable();
}

var setModifyCourrier_admin = (data, role) => {

    let row_count = document.querySelectorAll('#admin-modify-courriers tr[role="row"]').length + 1;
    let content = `
        <tr role="row" class="odd hover" id="row-${row_count}">
            <td>${data.id}</td>
            <td class="sorting_1 ellipsize" style="max-width: 250px;">${data.objet}</td>
            <td>${data.prestataire}</td>
            <td><span class="text-truncate align-middle text-nowrap">${data.date}</span></td>
            <td>
                <div class="d-flex justify-content-left align-items-center">
                    <div class="d-flex flex-column">
                        <a href="javascript:void()" class="user_name text-truncate">
                            <span class="font-weight-bold">${data.nom} ${data.prenom}</span>
                        </a>
                        <small class="emp_post text-muted">${data.telephone}</small>
                    </div>
                </div>
            </td>
            <td>
                <div class="btn-group">
                    <button class="btn btn-sm hide-arrow" data-toggle="dropdown">
                        <i class="feather icon-more-vertical font-medium-3 text-muted cursor-pointer"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- <a href="/${role}/couriers/${data.id}" id="type-success" class="dropdown-item" style="padding: 7px 9px;"> -->
                        <a href="/${role}/courier-details/${data.id}" class="dropdown-item" style="padding: 7px 9px;">
                            <i class="feather icon-file-text" style="font-size: 1.5rem;"></i>
                            &nbsp;&nbsp;&nbsp;Details
                        </a>
                        <a href="javascript:void()" class="dropdown-item assigner_btn" style="padding: 7px 9px;"
                            tabindex="0"
                            aria-controls="courier_table_admin"
                            type="button"
                            data-courier="${data.id}/${data.categorie}/${data.nbPiece}/${row_count}"
                            data-toggle="modal"
                            data-target="#assign-doc-modal">

                            <i class="feather icon-send" style="font-size: 1.5rem;"></i>
                            &nbsp;&nbsp;&nbsp;Assigner
                        </a>
                        <a href="javascript:void()" class="dropdown-item reject_btn" style="padding: 7px 9px;"
                            tabindex="0"
                            aria-controls="courier_table_admin"
                            type="button"
                            data-courier="${data.id}/reject/${row_count}"
                            data-toggle="modal"
                            data-target="#confirm-reject-modal">

                            <i class="feather icon-x-circle" style="font-size: 1.5rem;"></i>
                            &nbsp;&nbsp;&nbsp;Rejeter
                        </a>
                        <a href="javascript:void()" class="dropdown-item reject_btn" style="padding: 7px 9px;"
                            tabindex="0"
                            aria-controls="courier_table_admin"
                            type="button"
                            data-courier="${data.id}/modify/${row_count}"
                            data-toggle="modal"
                            data-target="#confirm-reject-modal">

                            <i class="feather icon-edit-2" style="font-size: 1.5rem;"></i>
                            &nbsp;&nbsp;&nbsp;Modifier
                        </a>
                    </div>
                </div>
            </td>
        </tr>`;

    $('#admin-modify-courriers').append(content);

    $("#modify_courier_table_admin").DataTable();
}

var setFinishCourrier_admin = (data, role) => {
    let row_count = document.querySelectorAll('#admin-finish-courriers tr[role="row"]').length + 1;
    let content = `
        <tr role="row" class="odd hover" id="row-${row_count}">
            <td>${data.id}</td>
            <td class="sorting_1 ellipsize" style="max-width: 250px;">${data.objet}</td>
            <td class="sorting_1 ellipsize" style="max-width: 250px;">${data.prestataire}</td>
            <td><span class="text-truncate align-middle text-nowrap">${data.date}</span></td>
            <td>
                <div class="btn-group">
                    <button class="btn btn-sm hide-arrow" data-toggle="dropdown">
                        <i class="feather icon-more-vertical font-medium-3 text-muted cursor-pointer"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- <a href="/${role}/couriers/${data.id}" id="type-success" class="dropdown-item" style="padding: 7px 9px;"> -->
                        <a href="/${role}/courier-details/${data.id}" class="dropdown-item" style="padding: 7px 9px;">
                            <i class="feather icon-file-text" style="font-size: 1.5rem;"></i>
                            &nbsp;&nbsp;&nbsp;Details
                        </a>
                        <a href="javascript:void()" class="dropdown-item assigner_btn validate-courier" style="padding: 7px 9px;"
                            type="button"
                            data-courier="${data.id}">
                            <i class="feather icon-check" style="font-size: 1.5rem;"></i>
                            &nbsp;&nbsp;&nbsp;Valider
                        </a>
                    </div>
                </div>
            </td>
        </tr>`;

    $('#admin-finish-courriers').append(content);

    $("#finish_courier_table_admin").DataTable();

}
