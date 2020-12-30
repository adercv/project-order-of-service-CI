<?php $this->view('layout/sidebar'); ?>

<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!--BreadCrumb Example-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/'); ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo?></li>
            </ol>
        </nav>

        <!--DataTables Example-->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a title="Cadastrar Novo Usuário" href="#" class="btn btn-success btn-sm-4 float-right"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Novo</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Usuário</th>
                                <th>Login</th>
                                <th>Ativo</th>
                                <th class="text-right no-sort">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $user): ?>
                                <tr>
                                    <td><?php echo $user->id ?></td>
                                    <td><?php echo $user->username ?></td>
                                    <td><?php echo $user->email ?></td>
                                    <td><?php echo $user->active ?></td>
                                    <td class="text-right">
                                        <a title="Editar" href="" class="btn btn-sm btn-primary"><i class="fas fa-user-edit"></i></a>
                                        <a title="Excluir" href="" class="btn btn-sm btn-danger"><i class="fas fa-user-times"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->