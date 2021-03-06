<script src="//oss.maxcdn.com/bootbox/4.2.0/bootbox.min.js"></script>

<!--
Data items are displayed in table cells.
Each edit button has data-id="..." attribute to indicate the id of item
-->


<script>
$(document).ready(function() {
    $('#userForm')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: 'The full name is required'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z\s]+$/,
                            message: 'The full name can only consist of alphabetical characters'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'The email address is required'
                        },
                        emailAddress: {
                            message: 'The email address is not valid'
                        }
                    }
                },
                website: {
                    validators: {
                        notEmpty: {
                            message: 'The website address is required'
                        },
                        uri: {
                            allowEmptyProtocol: true,
                            message: 'The website address is not valid'
                        }
                    }
                }
            }
        })
        .on('success.form.fv', function(e) {
            // Save the form data via an Ajax request
            e.preventDefault();

            var $form = $(e.target),
                id    = $form.find('[name="id"]').val();

            // The url and method might be different in your application
            $.ajax({
                url: 'http://jsonplaceholder.typicode.com/users/' + id,
                method: 'PUT',
                data: $form.serialize()
            }).success(function(response) {
                // Get the cells
                var $button = $('button[data-id="' + response.id + '"]'),
                    $tr     = $button.closest('tr'),
                    $cells  = $tr.find('td');

                // Update the cell data
                $cells
                    .eq(1).html(response.name).end()
                    .eq(2).html(response.email).end()
                    .eq(3).html(response.website).end();

                // Hide the dialog
                $form.parents('.bootbox').modal('hide');

                // You can inform the user that the data is updated successfully
                // by highlighting the row or showing a message box
                bootbox.alert('The user profile is updated');
            });
        });

    $('.editButton').on('click', function() {
        // Get the record's ID via attribute
        var id = $(this).attr('data-id');

        $.ajax({
            url: 'http://jsonplaceholder.typicode.com/users/' + id,
            method: 'GET'
        }).success(function(response) {
            // Populate the form fields with the data returned from server
            $('#userForm')
                .find('[name="id"]').val(response.id).end()
                .find('[name="name"]').val(response.name).end()
                .find('[name="email"]').val(response.email).end()
                .find('[name="website"]').val(response.website).end();

            // Show the dialog
            bootbox
                .dialog({
                    title: 'Edit the user profile',
                    message: $('#userForm'),
                    show: false // We will show it manually later
                })
                .on('shown.bs.modal', function() {
                    $('#userForm')
                        .show()                             // Show the login form
                        .formValidation('resetForm'); // Reset form
                })
                .on('hide.bs.modal', function(e) {
                    // Bootbox will remove the modal (including the body which contains the login form)
                    // after hiding the modal
                    // Therefor, we need to backup the form
                    $('#userForm').hide().appendTo('body');
                })
                .modal('show');
        });
    });
});
</script>







<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full name</th>
                <th>Email</th>
                <th>Website</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Leanne Graham</td>
                <td>Sincere@april.biz</td>
                <td>hildegard.org</td>
                <td><button type="button" data-id="1" class="btn btn-default editButton">Edit</button></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Ervin Howell</td>
                <td>Shanna@melissa.tv</td>
                <td>anastasia.net</td>
                <td><button type="button" data-id="2" class="btn btn-default editButton">Edit</button></td>
            </tr>
            <tr>
                <td>3</td>
                <td>Clementine Bauch</td>
                <td>Nathan@yesenia.net</td>
                <td>ramiro.info</td>
                <td><button type="button" data-id="3" class="btn btn-default editButton">Edit</button></td>
            </tr>
            <tr>
                <td>4</td>
                <td>Patricia Lebsack</td>
                <td>Julianne.OConner@kory.org</td>
                <td>kale.biz</td>
                <td><button type="button" data-id="4" class="btn btn-default editButton">Edit</button></td>
            </tr>
            <tr>
                <td>5</td>
                <td>Chelsey Dietrich</td>
                <td>Lucio_Hettinger@annie.ca</td>
                <td>demarco.info</td>
                <td><button type="button" data-id="5" class="btn btn-default editButton">Edit</button></td>
            </tr>
            <tr>
                <td>6</td>
                <td>Mrs. Dennis Schulist</td>
                <td>Karley_Dach@jasper.info</td>
                <td>ola.org</td>
                <td><button type="button" data-id="6" class="btn btn-default editButton">Edit</button></td>
            </tr>
            <tr>
                <td>7</td>
                <td>Kurtis Weissnat</td>
                <td>Telly.Hoeger@billy.biz</td>
                <td>elvis.io</td>
                <td><button type="button" data-id="7" class="btn btn-default editButton">Edit</button></td>
            </tr>
            <tr>
                <td>8</td>
                <td>Nicholas Runolfsdottir V</td>
                <td>Sherwood@rosamond.me</td>
                <td>jacynthe.com</td>
                <td><button type="button" data-id="8" class="btn btn-default editButton">Edit</button></td>
            </tr>
            <tr>
                <td>9</td>
                <td>Glenna Reichert</td>
                <td>Chaim_McDermott@dana.io</td>
                <td>conrad.com</td>
                <td><button type="button" data-id="9" class="btn btn-default editButton">Edit</button></td>
            </tr>
            <tr>
                <td>10</td>
                <td>Clementina DuBuque</td>
                <td>Rey.Padberg@karina.biz</td>
                <td>ambrose.net</td>
                <td><button type="button" data-id="10" class="btn btn-default editButton">Edit</button></td>
            </tr>
        </tbody>
    </table>
</div>

<!-- The form which is used to populate the item data -->
<form id="userForm" method="post" class="form-horizontal" style="display: none;">
    <div class="form-group">
        <label class="col-xs-3 control-label">ID</label>
        <div class="col-xs-3">
            <input type="text" class="form-control" name="id" disabled="disabled" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-3 control-label">Full name</label>
        <div class="col-xs-5">
            <input type="text" class="form-control" name="name" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-3 control-label">Email</label>
        <div class="col-xs-5">
            <input type="text" class="form-control" name="email" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-3 control-label">Website</label>
        <div class="col-xs-5">
            <input type="text" class="form-control" name="website" />
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-5 col-xs-offset-3">
            <button type="submit" class="btn btn-default">Save</button>
        </div>
    </div>
</form>

