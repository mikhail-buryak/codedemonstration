$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

var table = $('#users-table').DataTable({
    stateSave: true,
    processing: true,
    serverSide: true,
    ajax: '/workflow/items/all',
    columns: [
        {data: 'id', name: 'books.id'},
        {data: 'title', name: 'books.title'},
        {data: 'preview', name: 'books.preview'},
        {data: 'name', name: 'autors.name'},
        {data: 'write_at', name: 'books.write_at'},
        {data: 'created_at', name: 'books.created_at'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
});

$(function() {
    $('div.container table#users-table').on("click", "button.book-delete", function() {
        if(!confirm('Do you realy wont delete this item?')) return;

        var $this = $(this);

        $.ajax({
            url: $this.attr('data-action'),
            type: 'POST',
            dataType: 'JSON',
            success: function() { table.rows().remove().draw() },
            error: function() { alert('Can\'t delete this item. Try to reload page.') }
        });
    });

    $('div.container table#users-table').on("click", "button.btn-modal", function() {
        $('#myModal').remove();

        var $this = $(this);
        var $modal = $('<div class="modal fade" id="myModal" role="dialog"></div>');

        $('body').append($modal);
        $modal.load($this.attr('data-action'), function() { $modal.modal({ keyboard: true }) });
    });

    $('div.container table#users-table').on("click", "img.cover", function() {
        if($(this).hasClass('clicked')) {
            $(this).removeClass('clicked')
            return false;
        }
        $('img.cover').removeClass('clicked');
        $(this).addClass('clicked');
    });

    $('div.container table#users-table').on("mouseleave", "img.cover.clicked", function() { $(this).removeClass('clicked') });

    $('input[name=preview]').on('change', function() {
        $('#img_preview').css('width', "auto");
        readURL(this, $('#img_preview'));
        $('#img_changed').val('1');
    });

    function readURL(input, img) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) { img.attr('src', e.target.result) };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('body').on("submit", "form#editBook", function(e) {
        e.preventDefault();
        var $this = $(this);
        var formData = new FormData(document.forms.editBook);

        $('div.alerts').empty();

        $.ajax({
            url: $this.attr('action'),
            data: formData,
            contentType: false,
            processData: false,
            type: 'POST',
            dataType: 'JSON',
            success: function() {
                $('#myModal').modal('hide');
                table.rows().remove().draw() },
            error: function(response) {
                for(var e in response.responseJSON.data)
                    $('div.alerts').append('<div class="alert alert-danger fade in">'+response.responseJSON.data[e]+'</div>');
            }
        });
        return false;
    });
});