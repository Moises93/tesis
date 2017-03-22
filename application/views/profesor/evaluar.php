<?php
/**
 * Created by PhpStorm.
 * User: Moises
 * Date: 16-03-2017
 * Time: 19:38
 */?>


    <!-- Font Awesome Icons -->

   
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <!-- /.box -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Aprobar Pasantes</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <table id="tblEvaluar" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Progreso</th>
                                    <th>Pasante</th>
                                    <th>Empresa</th>
                                    <th>Requisitos</th>
                                    <th><em class="fa fa-cog"></em></th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>


                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>

<div class="modal  bs-example-modal-lg"  id="modalInfoPasantia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="text-danger fa fa-times"></i></button>
                <h4 class="modal-title" id="myModalLabel"><i class="text-muted fa fa-shopping-cart"></i> <strong>02051</strong> - Nome do Produto </h4>
            </div>
            <div class="modal-body">

                <table class="pull-left col-md-8 ">
                    <tbody>
                    <tr>
                        <td class="h6"><strong>C&eacute;dula</strong></td>
                        <td> </td>
                        <td id="cedula" class="h5">cedula</td>
                    </tr>

                    <tr>
                        <td class="h6"><strong>Correo</strong></td>
                        <td> </td>
                        <td id="correo" class="h5">correo</td>
                    </tr>

                    <tr>
                        <td class="h6"><strong>Número de Telefono</strong></td>
                        <td> </td>
                        <td id="telefono" class="h5">Telefono</td>
                    </tr>

                    <tr>
                        <td class="h6"><strong>Escuela</strong></td>
                        <td> </td>
                        <td id="escuelac" class="h5">escuela</td>
                    </tr>

                    <tr>
                        <td class="h6"><strong>Tutor Academico</strong></td>
                        <td> </td>
                        <td id= "tutorA" class="h5">tutorA</td>
                    </tr>

                    <tr>
                        <td class="h6"><strong>Empresa</strong></td>
                        <td> </td>
                        <td id= "empresa" class="h5">empresa</td>
                    </tr>

                    <tr>
                        <td class="h6"><strong>Tutor Empresarial</strong></td>
                        <td> </td>
                        <td id= "tutorE" class="h5">tutorE</td>
                    </tr>

                    <tr>
                        <td class="h6"><strong>Modalidad</strong></td>
                        <td> </td>
                        <td id="modalidadp" class="h5">modalidad</td>
                    </tr>

                    <tr>
                        <td class="h6"><strong>Periodo</strong></td>
                        <td> </td>
                        <td id="periodop" class="h5">periodo</td>
                    </tr>

                    <!--<tr>
                        <td class="h6"><strong>Pendiente</strong></td>
                        <td> </td>
                        <td id="pendiente" class="h5">pendiente</td>
                    </tr>

                    <tr>
                        <td class="btn-mais-info text-primary">
                            <i class="open_info fa fa-plus-square-o"></i>
                            <i class="open_info hide fa fa-minus-square-o"></i> Pendiente
                        </td>
                        <td> </td>
                        <td  id="pendiente"  class="h5"></td>
                    </tr>-->

                    </tbody>
                </table>


                <div class="col-md-4">
                    <img id="img" src="" alt="teste" class="img-thumbnail">
                </div>

                <div class="clearfix"></div>
                <p class="open_info hide">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
            </div>

            <div class="modal-footer">

                <div class="text-left pull-left col-md-1" style="width: 350px;">
                    <strong> Pendiente: </strong><br/>
                    <span id="pendiente" class=""><strong> 30%</strong></span></span>
                </div>

                <div class="text-right pull-right col-md-3">
                    <strong>Progreso: </strong><br/>
                    <span id="progreso" class="h3 text-muted"><strong> 30%</strong></span></span>
                </div>

                <!-- <div class="text-right pull-right col-md-3">
                     Atacado: <br/>
                     <span class="h3 text-muted"><strong>R$35,00</strong></span> http://lorempixel.com/150/150/technics/
                 </div>-->

            </div>
        </div>
    </div>


</div>