<!-- Footer -->
<footer class="footer">
  <div class="row align-items-center justify-content-xl-between">
    <div class="col-xl-6">
      <div class="copyright text-center text-xl-left text-muted">
        &copy; 2021 <a href="https://www.lifearluxury.com/" class="font-weight-bold ml-1 text-default" target="_blank">{{ config('app.name') }}</a>
      </div>
    </div>
    <div class="col-xl-6">
      <ul class="nav nav-footer justify-content-center justify-content-xl-end">
        <li class="nav-item">
          <a href="#" data-toggle="modal" data-target="#exampleModaltyc" class="nav-link" target="">Terminos y Condiciones</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('guia.index') }}" class="nav-link">Centro de apoyo</a>
        </li>
      </ul>
    </div>
  </div>
</footer>

<div class="modal fade" id="exampleModaltyc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Terminos y Condiciones</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card shadow">
          <div class="row justify-content-center">    
          <object data="https://drive.google.com/file/d/1FtscjFnA9PajP3ZZZt6hMWNBnKxj6XNd/preview" type="application/pdf" width="600" height="500">
              <embed src="https://drive.google.com/file/d/1FtscjFnA9PajP3ZZZt6hMWNBnKxj6XNd/preview" width="300px" height="400px" />
                <p>&nbsp;This browser does not support PDF files. Download the PDF to view: 
                <a href="https://drive.google.com/file/d/1FtscjFnA9PajP3ZZZt6hMWNBnKxj6XNd/preview">Download PDF</a>.</p>
            </embed></object>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>        
      </div>
    </div>
  </div>
</div>


