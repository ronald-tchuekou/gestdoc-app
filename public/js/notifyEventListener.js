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
var agent_listener = (data) => {
    let assigne = data.assignes.find(({ user_id }) => user_id == default_user_id);
    let text_html = `
        <tr role="row" class="odd hover" id="row-${data.id}">
            <td class="p-1">
                <a href="/${default_user_role}/courriers/marck-as-recieved/${data.id}" data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Marquer comme reçut" class="cursor-pointer" data-id="${data.id}" >
                    <i class="feather icon-aperture text-warning" style="font-size: 2rem;
                        font-weight: bold;"></i>
                </a>
            </td>
            <td class="text-dark text-bold-700">${data.code}</td>
            <td>${data.prestataire}</td>
            <td>
                <div class="d-flex justify-content-left align-items-center">
                    <div class="d-flex flex-column">
                        <a href="javascript:void()" class="user_name text-truncate">
                            <span class="font-weight-bold">${data.personne.nom} ${data.personne.prenom}</span>
                        </a>
                        <small class="emp_post text-muted">${data.personne.telephone}</small>
                    </div>
                </div>
            </td>
            <td class="sorting_1 ellipsize" style="max-width: 300px;">${data.objet}</td>
            <td class="sorting_1 ellipsize" style="max-width: 350px;"><span>${assigne.tache}</span></td>
            <td class="text-truncate align-middle text-nowrap">${assigne.created_at}</td>
            <td>
                <button data-courier="${data.id}" class="btn btn-secondary btn-sm btn-traitement-finish">Terminer</button>
            </td>
        </tr>`;
    $('#agent-finish').append(text_html);

    update_badge_count('#badge-finish', 1);

    courier_manager();
}

/**
 * Ecouter les changements pour les admin. (Courriers modifié, Courriers Traité, Courriers Initialisés)
 */
var admin_listener = (data, action) => {
    console.log(data)
    if(action == 'init')
        setInitCourrier_admin(data);
    else if (action == 'modify')
        setModifyCourrier_admin(data);
    else if(action == 'finish')
        setFinishCourrier_admin(data);
}

var setModifyCourrier_accueil = (data) => {
    let text_content = `
        <tr role="row" class="odd hover" id="row-${data.id}">
            <td class="p-1">
                <a href="/${default_user_role}/courriers/marck-as-recieved/${data.id}" data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Marquer comme reçut" class="cursor-pointer" data-id="${data.id}" >
                    <i class="feather icon-aperture text-warning" style="font-size: 2rem;
                        font-weight: bold;"></i>
                </a>
            </td>
            <td class="text-dark text-bold-700">${data.code} </td>
            <td>
                <div class="d-flex justify-content-left align-items-center">
                    <div class="d-flex flex-column">
                        <a href="javascript:void()" class="user_name text-truncate">
                            <span class="font-weight-bold">${data.personne.nom} ${data.personne.prenom}</span>
                        </a>
                        <small class="emp_post text-muted">${data.personne.telephone}</small>
                    </div>
                </div>
            </td>
            <td class="sorting_1 ellipsize" style="max-width: 250px;">${data.objet}</td>
            <td><span class="text-truncate align-middle text-nowrap">${data.to_modify.reason}</span></td>
            <td class="text-truncate align-middle text-nowrap">${data.to_modify.created_at}</td>
            <td>
                <a href="/accueil/couriers/${data.id}/modify" class="btn btn-warning btn-sm">Modifier</a>
            </td>
        </tr>`;

    $('#accueil-modify').append(text_content);

    update_badge_count('#badge-modify', 1);

    courier_manager();
}

var setRejectCourrier_accueil = (data) => {
    let text_content = `
        <tr role="row" class="odd hover" id="row-${data.id}">
            <td class="p-1">
                <a href="/${default_user_role}/courriers/marck-as-recieved/${data.id}" data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Marquer comme reçut" class="cursor-pointer" data-id="${data.id}" >
                    <i class="feather icon-aperture text-warning" style="font-size: 2rem;
                        font-weight: bold;"></i>
                </a>
            </td>
            <td class="text-dark text-bold-700">${data.code} </td>
            <td>
                <div class="d-flex justify-content-left align-items-center">
                    <div class="d-flex flex-column">
                        <a href="javascript:void()" class="user_name text-truncate">
                            <span class="font-weight-bold">${data.personne.nom} ${data.personne.prenom}</span>
                        </a>
                        <small class="emp_post text-muted">${data.personne.telephone}</small>
                    </div>
                </div>
            </td>
            <td class="sorting_1 ellipsize" style="max-width: 250px;">${data.objet}</td>
            <td class="sorting_1 ellipsize" style="max-width: 250px;">${data.reject.reason}</td>
            <td class="text-truncate align-middle text-nowrap">${data.reject.created_at}</td>
            <td>
                
                <div class="btn-group">
                    <button class="btn btn-sm hide-arrow" data-toggle="dropdown">
                        <i class="feather icon-more-vertical font-medium-3 text-muted cursor-pointer"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- <a href="/${default_user_role}/couriers/${data.id}" id="type-success" class="dropdown-item" style="padding: 7px 9px;"> -->
                        <a href="/${default_user_role}/courier-details/${data.id}" class="dropdown-item" style="padding: 7px 9px;">
                            <i class="feather icon-file-text" style="font-size: 1.5rem;"></i>
                            &nbsp;&nbsp;&nbsp;Details
                        </a>
                        <a href="javascript:void()" class="dropdown-item observation_btn" style="padding: 7px 9px;"
                            tabindex="0"
                            aria-controls="courier_table_admin"
                            type="button"
                            data-courier="${data.id}/${default_user_id}/${default_user_role}"
                            data-toggle="modal"
                            data-target="#observation-modal">

                            <i class="feather icon-edit-2" style="font-size: 1.5rem;"></i>
                            &nbsp;&nbsp;&nbsp;Observation
                        </a>
                    </div>
                </div>

            </td>
        </tr>`;

    $('#accueil-reject').append(text_content);

    update_badge_count("#badge-reject", 1);

}

var setValidateCourrier_accueil = (data) => {
    let text_content = `
        <tr role="row" class="odd hover" id="row-${data.id}">
            <td class="p-1">
                <a href="/${default_user_role}/courriers/marck-as-recieved/${data.id}" data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Marquer comme reçut" class="cursor-pointer" data-id="${data.id}" >
                    <i class="feather icon-aperture text-warning" style="font-size: 2rem;
                        font-weight: bold;"></i>
                </a>
            </td>
            <td class="text-dark text-bold-700">${data.code} </td>
            <td>${data.prestataire}</td>
            <td>
                <div class="d-flex justify-content-left align-items-center">
                    <div class="d-flex flex-column">
                        <a href="javascript:void()" class="user_name text-truncate">
                            <span class="font-weight-bold">${data.personne.nom} ${data.personne.prenom}</span>
                        </a>
                        <small class="emp_post text-muted">${data.personne.telephone}</small>
                    </div>
                </div>
            </td>
            <td class="sorting_1 ellipsize" style="max-width: 250px;">${data.objet}</td>
            <td class="sorting_1 ellipsize" style="max-width: 200px">${data.observation}</td>
            <td class="text-truncate align-middle text-nowrap">${data.updated_at}</td>
            <td>

                <div class="btn-group">
                    <button class="btn btn-sm hide-arrow" data-toggle="dropdown">
                        <i class="feather icon-more-vertical font-medium-3 text-muted cursor-pointer"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- <a href="/${default_user_role}/couriers/${data.id}" id="type-success" class="dropdown-item" style="padding: 7px 9px;"> -->
                        <a href="/${default_user_role}/courier-details/${data.id}" class="dropdown-item" style="padding: 7px 9px;">
                            <i class="feather icon-file-text" style="font-size: 1.5rem;"></i>
                            &nbsp;&nbsp;&nbsp;Details
                        </a>
                        <a href="javascript:void()" class="dropdown-item observation_btn" style="padding: 7px 9px;"
                            tabindex="0"
                            aria-controls="courier_table_admin"
                            type="button"
                            data-courier="${data.id}/${default_user_id}/${default_user_role}"
                            data-toggle="modal"
                            data-target="#observation-modal">

                            <i class="feather icon-edit-2" style="font-size: 1.5rem;"></i>
                            &nbsp;&nbsp;&nbsp;Observation
                        </a>
                    </div>
                </div>

            </td>
        </tr>`;
                    
    $('#accueil-valide').append(text_content);
    update_badge_count('#badge-validate', 1);

    courier_manager();
}

var setInitCourrier_admin = (data) => {
    let text_content = `
            <tr role="row" class="odd hover" id="row-${data.id}">
                <td class="p-1">
                    <a href="/${default_user_role}/courriers/marck-as-recieved/${data.id}" data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Marquer comme reçut" class="cursor-pointer" data-id="${data.id}" >
                        <i class="feather icon-aperture text-warning" style="font-size: 2rem;
                            font-weight: bold;"></i>
                    </a>
                </td>
                <td class="text-dark text-bold-700">${data.code} </td>
                <td>${data.prestataire}</td>
                <td>
                    <div class="d-flex justify-content-left align-items-center">
                        <div class="d-flex flex-column">
                            <a href="javascript:void()" class="user_name text-truncate">
                                <span class="font-weight-bold">${data.personne.nom} ${data.personne.prenom}</span>
                            </a>
                            <small class="emp_post text-muted">${data.personne.telephone}</small>
                        </div>
                    </div>
                </td>
                <td class="sorting_1 ellipsize" style="max-width: 250px;">${data.objet}</td>
                <td><span class="text-truncate align-middle text-nowrap">${data.nbPiece}</span></td>
                <td><span class="badge badge-pill badge-light-info" text-capitalized="">${data.etat}</span></td>
                <td class="text-truncate align-middle text-nowrap">${data.dateEnregistrement}</td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-sm hide-arrow" data-toggle="dropdown">
                            <i class="feather icon-more-vertical font-medium-3 text-muted cursor-pointer"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- <a href="/${default_user_role}/couriers/${data.id}" id="type-success" class="dropdown-item" style="padding: 7px 9px;"> -->
                            <a href="/${default_user_role}/courier-details/${data.id}" class="dropdown-item" style="padding: 7px 9px;">
                                <i class="feather icon-file-text" style="font-size: 1.5rem;"></i>
                                &nbsp;&nbsp;&nbsp;Details
                            </a>
                            <a href="javascript:void()" class="dropdown-item assigner_btn" style="padding: 7px 9px;"
                                tabindex="0"
                                aria-controls="courier_table_admin"
                                type="button"
                                data-courier="${data.id}/${data.categorie.intitule}/${data.nbPiece}/${data.id}"
                                data-toggle="modal"
                                data-target="#assign-doc-modal">

                                <i class="feather icon-send" style="font-size: 1.5rem;"></i>
                                &nbsp;&nbsp;&nbsp;Assigner
                            </a>
                            <a href="javascript:void()" class="dropdown-item reject_btn" style="padding: 7px 9px;"
                                tabindex="0"
                                aria-controls="courier_table_admin"
                                type="button"
                                data-courier="${data.id}/reject/${data.id}"
                                data-toggle="modal"
                                data-target="#confirm-reject-modal">

                                <i class="feather icon-x-circle" style="font-size: 1.5rem;"></i>
                                &nbsp;&nbsp;&nbsp;Rejeter
                            </a>
                            <a href="javascript:void()" class="dropdown-item reject_btn" style="padding: 7px 9px;"
                                tabindex="0"
                                aria-controls="courier_table_admin"
                                type="button"
                                data-courier="${data.id}/modify/${data.id}"
                                data-toggle="modal"
                                data-target="#confirm-reject-modal">

                                <i class="feather icon-edit-2" style="font-size: 1.5rem;"></i>
                                &nbsp;&nbsp;&nbsp;Modifier
                            </a>
                        </div>
                    </div>
                </td>
            </tr>`;
    $('#admin-initial-courriers').append(text_content);

    $("#init_courier_table_admin").DataTable();

    update_badge_count("#badge-initial", 1);
    courier_manager();
}

var setModifyCourrier_admin = (data) => {
    let text_content = `
        <tr role="row" class="odd hover" id="row-${data.id}">
            <td class="p-1">
                <a href="/${default_user_role}/courriers/marck-as-recieved/${data.id}" data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Marquer comme reçut" class="cursor-pointer" data-id="${data.id}" >
                    <i class="feather icon-aperture text-warning" style="font-size: 2rem;
                        font-weight: bold;"></i>
                </a>
            </td>
            <td class="text-dark text-bold-700">${data.code} </td>
            <td>${data.prestataire}</td>
            <td>
                <div class="d-flex justify-content-left align-items-center">
                    <div class="d-flex flex-column">
                        <a href="javascript:void()" class="user_name text-truncate">
                            <span class="font-weight-bold">${data.personne.nom} ${data.personne.prenom}</span>
                        </a>
                        <small class="emp_post text-muted">${data.personne.telephone}</small>
                    </div>
                </div>
            </td>
            <td class="sorting_1 ellipsize" style="max-width: 250px;">${data.objet}</td>
            <td><span class="text-truncate align-middle text-nowrap">${data.nbPiece}</span></td>
            <td><span class="badge badge-pill badge-light-info" text-capitalized="">${data.etat}</span></td>
            <td class="text-truncate align-middle text-nowrap">${data.updated_at}</td>
            <td>
                <div class="btn-group">
                    <button class="btn btn-sm hide-arrow" data-toggle="dropdown">
                        <i class="feather icon-more-vertical font-medium-3 text-muted cursor-pointer"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- <a href="/${default_user_role}/couriers/${data.id}" id="type-success" class="dropdown-item" style="padding: 7px 9px;"> -->
                        <a href="/${default_user_role}/courier-details/${data.id}" class="dropdown-item" style="padding: 7px 9px;">
                            <i class="feather icon-file-text" style="font-size: 1.5rem;"></i>
                            &nbsp;&nbsp;&nbsp;Details
                        </a>
                        <a href="javascript:void()" class="dropdown-item assigner_btn" style="padding: 7px 9px;"
                            tabindex="0"
                            aria-controls="courier_table_admin"
                            type="button"
                            data-courier="${data.id}/${data.categorie.intitule}/${data.nbPiece}/${data.id}"
                            data-toggle="modal"
                            data-target="#assign-doc-modal">

                            <i class="feather icon-send" style="font-size: 1.5rem;"></i>
                            &nbsp;&nbsp;&nbsp;Assigner
                        </a>
                        <a href="javascript:void()" class="dropdown-item reject_btn" style="padding: 7px 9px;"
                            tabindex="0"
                            aria-controls="courier_table_admin"
                            type="button"
                            data-courier="${data.id}/reject/${data.id}"
                            data-toggle="modal"
                            data-target="#confirm-reject-modal">

                            <i class="feather icon-x-circle" style="font-size: 1.5rem;"></i>
                            &nbsp;&nbsp;&nbsp;Rejeter
                        </a>
                        <a href="javascript:void()" class="dropdown-item reject_btn" style="padding: 7px 9px;"
                            tabindex="0"
                            aria-controls="courier_table_admin"
                            type="button"
                            data-courier="${data.id}/modify/${data.id}"
                            data-toggle="modal"
                            data-target="#confirm-reject-modal">

                            <i class="feather icon-edit-2" style="font-size: 1.5rem;"></i>
                            &nbsp;&nbsp;&nbsp;Modifier
                        </a>
                    </div>
                </div>
            </td>
        </tr>`;

    $('#admin-modify-courriers').append(text_content);

    $("#modify_courier_table_admin").DataTable();

    update_badge_count("#badge-modify", 1);
    courier_manager();
}

var setFinishCourrier_admin = (data) => {
    let text_content = `
        <tr role="row" class="odd hover" id="row-${data.id}">
            <td class="p-1">
                <a href="/${default_user_role}/courriers/marck-as-recieved/${data.id}" data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Marquer comme reçut" class="cursor-pointer" data-id="${data.id}" >
                    <i class="feather icon-aperture text-warning" style="font-size: 2rem;
                        font-weight: bold;"></i>
                </a>
            </td>
            <td class="text-dark text-bold-700">${data.code} </td>
            <td class="sorting_1 ellipsize" style="max-width: 250px; width: 250px">${data.prestataire}</td>
            <td>
                <div class="d-flex justify-content-left align-items-center">
                    <div class="d-flex flex-column">
                        <a href="javascript:void()" class="user_name text-truncate">
                            <span class="font-weight-bold">${data.personne.nom} ${data.personne.prenom}</span>
                        </a>
                        <small class="emp_post text-muted">${data.personne.telephone}</small>
                    </div>
                </div>
            </td>
            <td class="sorting_1 ellipsize" style="max-width: 250px; width: 250px">${data.objet}</td>
            <td class="sorting_1 ellipsize" style="max-width: 200px; width: 200px">${data.observation}</td>
            <td><span class="text-truncate align-middle text-nowrap">${data.updated_at}</span></td>
            <td>
                <div class="btn-group">
                    <button class="btn btn-sm hide-arrow" data-toggle="dropdown">
                        <i class="feather icon-more-vertical font-medium-3 text-muted cursor-pointer"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- <a href="/${default_user_role}/couriers/${data.id}" id="type-success" class="dropdown-item" style="padding: 7px 9px;"> -->
                        <a href="/${default_user_role}/courier-details/${data.id}" class="dropdown-item" style="padding: 7px 9px;">
                            <i class="feather icon-file-text" style="font-size: 1.5rem;"></i>
                            &nbsp;&nbsp;&nbsp;Details
                        </a>
                        <a href="javascript:void()" class="dropdown-item assigner_btn validate-courier" style="padding: 7px 9px;"
                            type="button"
                            data-courier="${data.id}">
                            <i class="feather icon-check" style="font-size: 1.5rem;"></i>
                            &nbsp;&nbsp;&nbsp;Valider
                        </a>
                        <a href="javascript:void()" class="dropdown-item observation_btn" style="padding: 7px 9px;"
                            tabindex="0"
                            aria-controls="courier_table_admin"
                            type="button"
                            data-courier="${data.id}/${default_user_id}/${default_user_role}"
                            data-toggle="modal"
                            data-target="#observation-modal">

                            <i class="feather icon-edit-2" style="font-size: 1.5rem;"></i>
                            &nbsp;&nbsp;&nbsp;Observation
                        </a>
                    </div>
                </div>
            </td>
        </tr>`;

    $('#admin-finish-courriers').append(text_content);

    $("#finish_courier_table_admin").DataTable();

    update_badge_count("#badge-finish", 1);

    courier_manager();
}