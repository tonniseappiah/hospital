type = ['primary', 'info', 'success', 'warning', 'danger'];

notification = {

    invalid_email: function(from, align) {
        color = "4";

        $.notify({
            icon: "ni ni-bell-55",
            message: " <b>Invalid Email Address </b> - Please check and enter it correctly."

        }, {
            type: type[3],
            timer: 4000,
            placement: {
                from: from,
                align: align
            }
        });
    },

    invalid_password: function(from, align) {
        color = "4";

        $.notify({
            icon: "ni ni-bell-55",
            message: " <b>Invalid Password </b> - Password is less than 6 characters."

        }, {
            type: type[3],
            timer: 4000,
            placement: {
                from: from,
                align: align
            }
        });
    },

    incorrect_email: function(from, align) {
        color = "4";

        $.notify({
            icon: "ni ni-bell-55",
            message: " <b>You have entered an incorrect email address. </b>"

        }, {
            type: type[3],
            timer: 4000,
            placement: {
                from: from,
                align: align
            }
        });
    },

    unmatched_password: function(from, align) {
        color = "4";

        $.notify({
            icon: "ni ni-bell-55",
            message: " <b>The password entered does not match the email. </b>"

        }, {
            type: type[3],
            timer: 4000,
            placement: {
                from: from,
                align: align
            }
        });
    },

    session_died: function(from, align) {
        color = "4";

        $.notify({
            icon: "ni ni-bell-55",
            message: " <b>Your Session has died </b> - Please re-login."

        }, {
            type: type[3],
            timer: 4000,
            placement: {
                from: from,
                align: align
            }
        });
    },

    labItemExist: function(from, align) {
        color = "4";

        $.notify({
            icon: "ni ni-bell-55",
            message: " <b> The lab item already exist </b> - Please check and try again."

        }, {
            type: type[3],
            timer: 3000,
            placement: {
                from: from,
                align: align
            }
        });
    },

    labItemFailed: function(from, align) {
        color = "4";

        $.notify({
            icon: "ni ni-bell-55",
            message: " <b> Lab item insertion failed </b> - Please try again."

        }, {
            type: type[3],
            timer: 3000,
            placement: {
                from: from,
                align: align
            }
        });
    },

    emptyRequest: function(from, align) {
        color = "4";

        $.notify({
            icon: "ni ni-bell-55",
            message: " <b> Lab request is empty </b> - Select at least one."

        }, {
            type: type[3],
            timer: 1000,
            placement: {
                from: from,
                align: align
            }
        });
    },

    labRequestSuccess: function(from, align) {
        color = "2";

        $.notify({
            icon: "ni ni-bell-55",
            message: " <b> Lab Requested Successful </b>"

        }, {
            type: type[2],
            timer: 1000,
            placement: {
                from: from,
                align: align
            }
        });
    },

    labPerformSuccess: function(from, align) {
        color = "2";

        $.notify({
            icon: "ni ni-bell-55",
            message: " <b> Lab Record Inserted Successful </b>"

        }, {
            type: type[2],
            timer: 1000,
            placement: {
                from: from,
                align: align
            }
        });
    },

};