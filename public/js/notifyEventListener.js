/**
 * NotifyEventListener.js
 * 
 * Fichier qui permet de faire des notifications au utilisateurs.
 * 
 * @author Ronald Tchuekou.
 * @email ronaldtchuekou@gmail.com
 */

class ListenChange {
    
    user_id = -1;
    intervalID = -1;
    current_account = '';

    constructor(current_account, user_id, intervalID) {
        this.user_id = user_id;
        this.intervalID = intervalID;
        this.current_account = current_account;

        if (current_account == 'accueil') {
            this.accuiel_listener();
        }
        else if (current_account == 'admin') {
            this.admin_listener();
        }
        else if (current_account == 'agent') {
            this.agent_listener();
        }
        else if (current_account == 'root') {
            this.root_listener();
        }
        else {
            this.stopInterval();
        }
    }

    /**
     * Fonction qui permet d'envoyer une notification.
     */
    setNotification(data) {
        let badge = $('.badge-pill.noti');
        let notify_list = $('#notify-list');
        let notify_content = `<hr/><a class="d-flex" href="">
            <div class="media d-flex align-items-start">
                <div class="media-left">
                <div class="avatar"><img src="${data.user_profile}" alt="avatar" width="32" height="32"></div>
                </div>
                <div class="media-body">
                <p class="media-heading"><span class="font-weight-bolder">${data.action}</span></p><small class="notification-text">${data.content}.</small>
                </div>
            </div>
        </a>`;

        badge.show();
        let notify_count = parseInt($(badge[0]).html());

        $(badge).each((i, elt) => {
            $(elt).html(notify_count + 1);
        });

        $(notify_list).append(notify_content);

    }

    /**
     * Fonction qui permet de stopé l'intervalle.
     */
    stopInterval() {
        clearInterval(this.intervalID);
    }

    /**
     * Ecouter les changements pour un compte accueil. (Courriers à modifés, Courriers rejetés, Courriers validés.)
     */
    accuiel_listener() { 
        let route = HOST_BACKEND + '/' + this.current_account + '/handleChange/' + this.user_id;
        axios.get(route).then(response => {
            let data = response.data.record;
            
            if (response.status == 200) {
                if (data != undefined) {
                    if (data.etat == 'Reprendre')
                        this.setModifyCourrier(data);
                    else if (data.etat == 'Rejeté')
                        this.setRejectCourrier(data);
                    else
                        this.setValidateCourrier(data);
                }
            }
        }).catch(re => {
            toastr.error(re, 'Erreur');
        });
    }

    /**
     * Ecouter les changements pour les agent. (Les courriers assignés.)
     */
    agent_listener() {
        let route = HOST_BACKEND + '/' + this.current_account + '/handleChange/' + this.user_id;
        axios.get(route).then(response => {
            let data = response.data.record;

            if (response.status == 200 && data != undefined) {
                
                let emptyLine = $('#agent-finish #row-empty');
                let row_count = document.querySelectorAll('#agent-finish tr[role="row"]').length + 1;
                let content = `<tr role="row" class="odd hover" id="row-${row_count}">
                                <td>
                                    ${data.id}
                                </td>
                                <td class="sorting_1 ellipsize" style="max-width: 250px;">${data.objet}</td>
                                <td><span>${data.tache}</span></td>
                                <td>${data.created_at}</td>
                                <td>
                                    <button data-courier="${data.id}" class="btn btn-secondary btn-sm btn-traitement-finish">Terminer</button>
                                </td>
                            </tr>`;
                
                this.setNotification(data);
        
                if (emptyLine != undefined)
                    emptyLine.remove();
                $('#agent-finish').append(content);
        
                toastr.info('Un nouveau courrier vous à été assigné', 'Information',
                    { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3 });
           
            }
        }).catch(re => {
            toastr.error(re, 'Erreur');
        });
    }

    /**
     * Ecouter les changements pour les admin. (Courriers modifié, Courriers Traité, Courriers Initialisés)
     */
    admin_listener() {
        console.log('Pour un admin.');
        let route = HOST_BACKEND + '/' + this.current_account + '/handle-new-courrier-init';
        axios.get(route).then(response => {
            let data = response.data.record;

            console.log('Data : ', response)

            if (response.status == 200 && data != null) {
                let courier = data;
                let emptyLine = $('#admin-initial-courriers #row-empty');
                let row_count = document.querySelectorAll('#admin-initial-courriers tr[role="row"]').length + 1;
                let content = `<tr role="row" class="odd hover" id="row-${row_count}">
                                    <td>${courier.id} </td>
                                    <td>
                                        <div class="d-flex justify-content-left align-items-center">
                                            <div class="d-flex flex-column">
                                                <a href="javascript:void()" class="user_name text-truncate">
                                                    <span class="font-weight-bold">${courier.nom} ${courier.prenom}</span>
                                                </a>
                                                <small class="emp_post text-muted">${courier.telephone}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="sorting_1 ellipsize" style="max-width: 250px;">${courier.objet}</td>
                                    <td><span class="text-truncate align-middle text-nowrap">${courier.nbPiece}</span></td>
                                    <td>${courier.prestataire}</td>
                                    <td><span class="badge badge-pill badge-light-info" text-capitalized="">${courier.etat}</span></td>
                                    <td>${courier.date}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm hide-arrow" data-toggle="dropdown">
                                                <i class="feather icon-more-vertical font-medium-3 text-muted cursor-pointer"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <!-- <a href="/admin/couriers/${courier.id}" id="type-success" class="dropdown-item" style="padding: 7px 9px;"> -.
                                                <a href="/${this.current_account}/courier-details/${courier.id}" class="dropdown-item" style="padding: 7px 9px;">
                                                    <i class="feather icon-file-text" style="font-size: 1.5rem;"></i>
                                                    &nbsp;&nbsp;&nbsp;Details
                                                </a>
                                                <a href="javascript:void()" class="dropdown-item assigner_btn" style="padding: 7px 9px;"
                                                    tabindex="0" 
                                                    aria-controls="courier_table_admin" 
                                                    type="button" 
                                                    data-courier="${courier.id}/${courier.categorie}/${courier.nbPiece}/${row_count}"
                                                    data-toggle="modal"
                                                    data-target="#assign-doc-modal">

                                                    <i class="feather icon-send" style="font-size: 1.5rem;"></i>
                                                    &nbsp;&nbsp;&nbsp;Assigner
                                                </a>
                                                <a href="javascript:void()" class="dropdown-item reject_btn" style="padding: 7px 9px;"
                                                    tabindex="0" 
                                                    aria-controls="courier_table_admin" 
                                                    type="button" 
                                                    data-courier="${courier.id}/reject/${row_count}"
                                                    data-toggle="modal"
                                                    data-target="#confirm-reject-modal">

                                                    <i class="feather icon-x-circle" style="font-size: 1.5rem;"></i>
                                                    &nbsp;&nbsp;&nbsp;Rejeter
                                                </a>
                                                <a href="javascript:void()" class="dropdown-item reject_btn" style="padding: 7px 9px;"
                                                    tabindex="0" 
                                                    aria-controls="courier_table_admin" 
                                                    type="button" 
                                                    data-courier="${courier.id}/modify/${row_count}"
                                                    data-toggle="modal"
                                                    data-target="#confirm-reject-modal">

                                                    <i class="feather icon-edit-2" style="font-size: 1.5rem;"></i>
                                                    &nbsp;&nbsp;&nbsp;Modifier
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>`;
                
                this.setNotification(data);
        
                if (emptyLine != undefined)
                    emptyLine.remove();
                $('#admin-initial-courriers').prepend(content);
        
                toastr.info('Un nouveau courrier vous à été assigné', 'Information',
                    { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3 });
           
            }
        }).catch(reason => {
            toastr.error(reason, 'Erreur');
        });
    }

    /**
     * Ecouter les changements pour les root. (Courriers modifié, Courriers Traité, Courriers Initialisés)
     */
    root_listener() {
        
    }

    setModifyCourrier(data) {

        let emptyLine = $('#accueil-modify #row-empty');
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
        
        this.setNotification(data);

        if (emptyLine != undefined)
            emptyLine.remove();
        $('#accueil-modify').append(content);

        toastr.info('Un nouveau courrier à été retourné pour une modification.', 'Information',
            { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3 });
    }

    setRejectCourrier(data) {
        let emptyLine = $('#accueil-reject #row-empty');
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
                            <a href="/${this.current_account}/courier-details/${data.id}" class="btn btn-info btn-sm">
                                <i class="feather icon-file-text" style="font-size: 1rem;"></i>
                                &nbsp;&nbsp;&nbsp;Details
                            </a>
                        </td>
                    </tr>`;
        
        this.setNotification(data);

        if (emptyLine != undefined)
            emptyLine.remove();
        $('#accueil-reject').append(content);

        toastr.warning('Un nouveau courrier à été rejeté', 'Information',
            { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3 });
    }

    setValidateCourrier(data) {
        let emptyLine = $('#accueil-valide #row-empty');
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
                                <a href="/${this.current_account}/courier-details/${data.id}" class="btn btn-info btn-sm">
                                    <i class="feather icon-file-text" style="font-size: 1rem;"></i>
                                    &nbsp;&nbsp;&nbsp;Details
                                </a>
                            </td>
                        </tr>`;
        
        this.setNotification(data);

        if (emptyLine != undefined)
            emptyLine.remove();
        $('#accueil-valide').append(content);

        toastr.success('Un nouveau courrier à été validé', 'Information',
            { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3e3 });
    }
    
}
