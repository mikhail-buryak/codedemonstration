<div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <form id="editBook" action="/workflow/items/store/{{ $book->id }}" enctype="multipart/form-data">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Book ID: {{ $book->id }}</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" value="{{ $book->title }}" id="name">
            </div>
            <div class="form-group">
                <label for="write_at">Write At</label>
                <input class="form-control" type="text" name="write_at" value="{{ $book->write_at }}" id="write_at">
            </div>
            <div class="form-group">
                <label for="preview">Preview</label>
                <input class="form-control" type="file" name="preview" id="preview">
                <div class="well well-sm" style="text-align: center">
                    <img src="/images/covers/{{ $book->preview }}" id="img_preview">
                </div>
                <input type="hidden" name="img_changed" id="img_changed" value="0">
                <span class="help-block">Recommended size : 200х100</span>
            </div>
        </div>

        <div class="modal-footer">
            <button class="btn btn-primary submit" type="submit" >Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <div class="alerts" style="margin-top: 10px;"></div>
        </div>

        </form>
    </div>
</div>