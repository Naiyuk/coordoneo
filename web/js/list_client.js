$(function () {
    const ajaxLoaderImgPath = "/img/ajax-loader.gif";
    const editIconClientPath= "/img/edit.png";
    const deleteIconClientPath= "/img/delete.png";
    const clientPerPage = 10;
    const baseApiClientUrl = '/api/clients';
    const baseClientUrl = '/clients';

    var clientsLength = $(".client-container").length;

    function createJboxNotice (color, message) {
        let jBNotice = new jBox("notice", {
            addClass: "jBox-wrapper jBox-Notice jBox-NoticeFancy jBox-Notice-color jBox-Notice-" + color,
            autoClose: 2500,
            fixed: true,
            position: { x: "left", y: "bottom" },
            offset: { x: 0, y: -20 },
            responsiveWidth: true,
            content: message,
            overlay: false,
            closeOnClick: "box",
            onCloseComplete: function () {
              this.destroy();
            }
        })

        return jBNotice;
    }

    function goToDeleteClient() {
        let url = $("#clientToRemove").text();
        $("#clientToRemove").text("");

        $.ajax({
            url: url,
            type: "DELETE",
            success: function(response) {
                $("a[href$='" + url + "']").parent().parent().remove();

                clientsLength--;

                let jBNotice = createJboxNotice("blue", "Le client a bien été supprimé !");
                jBNotice.open();

                if (clientsLength === 0 && $("#loadMoreClients").length === 0) {
                    let noClients = $("<h1 class='text-center text-white'></h1>");
                    noClients.text("Aucun client à afficher");

                    $("table").remove();
                    $(".table-responsive").append(noClients);
                }
            },
            error: function () {
                let jBNotice = createJboxNotice("red", "Une erreur est survenue");
                jBNotice.open();
            }
        });
    }

    function createAjaxLoader (id) {
        let loadImg = $("<img id=" + id +" class='mb-2 mt-3' src='" + ajaxLoaderImgPath + "' alt='loader'/>");
        loadImg.css("width", "48px").css("height", "48px");

        return loadImg;
    }

    function createLoadMoreButton (id) {
        let loadMore = $("<button id=" + id +" class='btn btn-primary mb-4 mt-3'>Voir plus</button>");

        return loadMore;
    }

    function createClientElement(id, name, firstName, address, postalCode, city, country, email) {

        let clientContainer = $("<tr class='client-container'></tr>");

        let tdName = $("<td></td>")
        tdName.text(name);

        let tdFirstName = $("<td></td>")
        tdFirstName.text(firstName);

        let tdAddress = $("<td></td>")
        tdAddress.text(address);

        let tdPostalCode = $("<td></td>")
        tdPostalCode.text(postalCode);

        let tdCity = $("<td></td>")
        tdCity.text(city);

        let tdCountry = $("<td></td>")
        tdCountry.text(country);

        let tdEmail = $("<td></td>")
        tdEmail.text(email);

        let tdControls = $("<td></td>")

        let editLink = $("<a class='mx-1 edit-client-link'></a>");
        editLink.attr('href', baseClientUrl + "/" + id + "/edit");

        let editImg = $("<img alt='Edit icon' />");
        editImg.attr('src', editIconClientPath)

        editLink.append(editImg);

        let deleteLink = $("<a class='mx-1 delete-client-link'></a>");
        deleteLink.attr('href', baseApiClientUrl + "/" + id + "/delete");

        deleteLink.click(function (event) {
            event.preventDefault();
        
            let link = $(this).attr("href");
        
            createDeleteClientModal(link);
            deleteClientModal.open();
        });

        let deleteImg = $("<img alt='Delete icon' />");
        deleteImg.attr('src', deleteIconClientPath)

        deleteLink.append(deleteImg);

        tdControls.append(editLink);
        tdControls.append(deleteLink);

        clientContainer.append(tdName);
        clientContainer.append(tdFirstName);
        clientContainer.append(tdAddress);
        clientContainer.append(tdPostalCode);
        clientContainer.append(tdCity);
        clientContainer.append(tdCountry);
        clientContainer.append(tdEmail);
        clientContainer.append(tdControls);

        return clientContainer;
    }

    function loadMoreClients (button, event) {
        event.preventDefault();

        let page = Math.ceil(clientsLength / clientPerPage) + 1;
        let url = baseApiClientUrl + "/" + page;
    
        button.replaceWith(createAjaxLoader("clientsLoader"));
    
        $.get(url, function (datas) {
            datas = JSON.parse(datas);
            if (datas.length === 0 && clientsLength === 0) {
                let noClients = $("<h1 class='text-center text-white'></h1>");
                noClients.text("Aucun client à afficher");

                $("table").remove();
                $(".table-responsive").append(noClients);
            }

            if (datas.length === 0) {
                $("#clientsLoader").remove();
                return;
            }

            $(datas).each(function () {
                let client = createClientElement(this['id'], this["name"], this["firstName"], this["address"], this['postalCode'], this['city'], this['country'], this['email']);
                clientsLength++;
                $("tbody").append(client);
            });

            if (datas.length < clientPerPage) {
                $("#clientsLoader").remove();
                return;
            }

            let loadMoreButton = createLoadMoreButton("clientsLoader");
            loadMoreButton.click(function (e) {
                loadMoreClients($(this), e);
            });
    
            $("#clientsLoader").replaceWith(loadMoreButton);
        }).fail(function () {
            $("#clientsLoader").remove();
            let jBNotice = createJboxNotice("red", "Une erreur est survenue");
            jBNotice.open();
        });
    }

    var deleteClientModal = new jBox("Confirm", {
        cancelButton: "Annuler",
        confirmButton: "Supprimer",
        confirm: goToDeleteClient,
    });

    function createDeleteClientModal(link) {
        let clientToRemoveLink = $("<p id='clientToRemove'>" + link + "</p>").hide();
        let modalContent = $("<p>Etes-vous sur de vouloir supprimer ce client ?</p>");

        let modalContainer = $("<div></div>");

        modalContainer.append(clientToRemoveLink);
        modalContainer.append(modalContent);

        deleteClientModal.setContent(modalContainer);
    }

    $(".delete-client-link").click(function (event) {
        event.preventDefault();
    
        let link = $(this).attr("href");
    
        createDeleteClientModal(link);
        deleteClientModal.open();
    });

    $("#loadMoreClients").click(function (event) {
        loadMoreClients($(this), event);
    });

    if ($(".client-container").length < clientPerPage) {
        $("#loadMoreClientsContainer").remove();
    }
})