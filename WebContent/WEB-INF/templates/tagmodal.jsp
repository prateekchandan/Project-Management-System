<div class="modal fade" id="tag-Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form method="post" action="${pageContext.request.contextPath}/add-tag">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Tag</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
        	<label>
        		Enter Tag Name
        	</label>
        	<input name="tagname" class="form-control">
        	<input type="hidden" name="returl" value="${requestScope['javax.servlet.forward.request_uri']}">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add Tag</button>
      </div>
    </div>
  </div>
</form>
</div>