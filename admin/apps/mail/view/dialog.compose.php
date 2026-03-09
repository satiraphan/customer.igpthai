<div class="modal fade" id="composeModal" tabindex="-1" role="dialog" aria-labelledby="composeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header d-flex align-items-center">
            <h6 class="modal-title mb-0" id="composeModalLabel">New Message</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <form name="form-email-compose">
                <div class="form-group">
                    <label for="mailTo">To</label>
                    <input name="to" type="email" class="form-control" id="mailTo" placeholder="Enter recipient's email address" autofocus>
                </div>
                <div class="form-group">
                    <label for="mailSubject">Subject</label>
                    <input name="subject" type="text" class="form-control" id="mailSubject" placeholder="Enter subject">
                    </div>
                    <textarea name="body" class="form-control summernote" id="mailBody"></textarea>
                    <div class="custom-file form-control-sm mt-3" style="max-width: 300px">
                    <input name="attachment" type="file" class="custom-file-input" id="customFile" multiple>
                    <label class="custom-file-label" for="customFile">Attachment</label>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" onclick="fn.app.mail.gmail.send_mail()">Send</button>
        </div>
        </div>
    </div>
</div>
