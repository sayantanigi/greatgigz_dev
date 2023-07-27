 <?php
 $seg1=$this->uri->segment(2);
 ?>
 <div class="col-md-3">
          <a href="<?= admin_url('mailer/composeemail')?>" class="btn btn-secondary btn-block mb-3">Compose</a>

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Folders</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">

                <li class="nav-item">
                  <a href="<?= admin_url('email_template/index/existing-template')?>" class="nav-link <?= ($seg1=='add-use-template')?'active':'';?>">
                      <i class="far fa-file-alt"></i> Use Template
                    </a>
                </li>
                 <li class="nav-item">
                  <a href="<?= admin_url('sent-mail')?>" class="nav-link <?= ($seg1=='sent-mail')?'active':'';?>">
                    <i class="far fa-envelope"></i> Sent
                  </a>
                </li>
                <li class="nav-item ">
                  <a href="<?= admin_url('mailer')?>" class="nav-link <?= ($seg1=='mailer')?'active':'';?>">
                    <i class="far fa-file-alt"></i> List of Drafts
                  </a>
                </li>

              </ul>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
