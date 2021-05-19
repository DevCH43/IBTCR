@extends('layouts.app')

@section('contenedor')

    <div class="card">
        <div class="card-header">
            <h3>Titulo el titulo de la tabla</h3>
        </div>
        <div class="card-body">








            <table id="simple-table" class="mb-0 table table-borderless table-bordered-x brc-secondary-l3 text-dark-m2 radius-1 overflow-hidden">
                <thead class="text-dark-tp3 bgc-grey-l4 text-90 border-b-1 brc-transparent">
                <tr>
                    <th class="text-center pr-0">
                        <label class="py-0">
                            <input type="checkbox" class="align-bottom mb-n1 border-2 text-dark-m3" />
                        </label>
                    </th>

                    <th>
                        Domain
                    </th>

                    <th>
                        Price
                    </th>

                    <th class="d-none d-sm-table-cell">
                        Clicks
                    </th>

                    <th class='d-none d-sm-table-cell'>
                        Update
                    </th>

                    <th class="d-none d-sm-table-cell">
                        Status
                    </th>

                    <th></th>
                    <th></th>
                </tr>
                </thead>

                <tbody class="mt-1">
                <tr class="bgc-h-yellow-l4 d-style">
                    <td class='text-center pr-0 pos-rel'>
                        <div class="position-tl h-100 ml-n1px border-l-4 brc-orange-m1 v-hover">
                            <!-- border shown on hover -->
                        </div>
                        <div class="position-tl h-100 ml-n1px border-l-4 brc-success-m1 v-active">
                            <!-- border shown when row is selected -->
                        </div>

                        <label>
                            <input type="checkbox" class="align-middle" />
                        </label>
                    </td>

                    <td>
                        <a href='#' class='text-blue-d1 text-600 text-95'>ace.com</a>
                    </td>

                    <td class="text-600 text-orange-d2">
                        $45
                    </td>

                    <td class='d-none d-sm-table-cell text-grey-d1'>
                        3,330
                    </td>

                    <td class='d-none d-sm-table-cell text-grey text-95'>
                        Feb 12
                    </td>

                    <td class='d-none d-sm-table-cell'>
                        <span class='badge badge-sm bgc-warning-d1 text-white pb-1 px-25'>Expiring</span>



                    </td>

                    <td class='text-center pr-0'>
                        <div>
                            <a href="#" data-toggle="collapse" data-target="#table-detail-0" class="d-style btn btn-outline-info text-90 text-600 border-0 px-2 collapsed" title="Show Details">
                                  <span class="d-none d-md-inline mr-1">
											Details
										</span>
                                <i class="fa fa-angle-down toggle-icon opacity-1 text-90"></i>
                            </a>
                        </div>
                    </td>

                    <td>
                        <!-- action buttons -->
                        <div class='d-none d-lg-flex'>
                            <a href="#" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                                <i class="fa fa-pencil-alt"></i>
                            </a>

                            <a href="#" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
                                <i class="fa fa-trash-alt"></i>
                            </a>
                            <a href="#" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-warning btn-a-lighter-warning">
                                <i class="fa fa-ellipsis-v mx-1"></i>
                            </a>
                        </div>

                        <!-- show a dropdown in mobile -->
                        <div class='dropdown d-inline-block d-lg-none dd-backdrop dd-backdrop-none-lg'>
                            <a href='#' class='btn btn-default btn-xs py-15 radius-round dropdown-toggle' data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </a>

                            <div class="dropdown-menu dd-slide-up dd-slide-none-lg">
                                <div class="dropdown-inner">
                                    <div class="dropdown-header text-100 text-secondary-d1 border-b-1 brc-secondary-l2 text-600 mb-2">
                                        ace.com
                                    </div>
                                    <a href="#" class="dropdown-item">
                                        <i class="fa fa-pencil-alt text-blue mr-1 p-2 w-4"></i>
                                        Edit
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                        Delete
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="far fa-flag text-orange-d1 mr-1 p-2 w-4"></i>
                                        Flag
                                    </a>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>

                <!-- detail row -->
                <tr class="border-0 detail-row bgc-white">
                    <td colspan="8" class="p-0 border-none brc-secondary-l2">
                        <div class="table-detail collapse" id="table-detail-0">
                            <div class="row">
                                <div class="col-12 col-md-10 offset-md-1 p-4">
                                    <div class="alert bgc-secondary-l4 text-dark-m2 border-none border-l-4 brc-primary-m1 radius-0 mb-0">
                                        <h4 class="text-primary">
                                            Row Details
                                        </h4>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="bgc-h-yellow-l4 d-style">
                    <td class='text-center pr-0 pos-rel'>
                        <div class="position-tl h-100 ml-n1px border-l-4 brc-orange-m1 v-hover">
                            <!-- border shown on hover -->
                        </div>
                        <div class="position-tl h-100 ml-n1px border-l-4 brc-success-m1 v-active">
                            <!-- border shown when row is selected -->
                        </div>

                        <label>
                            <input type="checkbox" class="align-middle" />
                        </label>
                    </td>

                    <td>
                        <a href='#' class='text-blue-d1 text-600 text-95'>base.com</a>
                    </td>

                    <td class="text-600 text-orange-d2">
                        $35
                    </td>

                    <td class='d-none d-sm-table-cell text-grey-d1'>
                        2,595
                    </td>

                    <td class='d-none d-sm-table-cell text-grey text-95'>
                        Feb 18
                    </td>

                    <td class='d-none d-sm-table-cell'>

                        <span class='badge badge-sm bgc-green-d1 text-white pb-1 px-25'>Registered</span>


                    </td>

                    <td class='text-center pr-0'>
                        <div>
                            <a href="#" data-toggle="collapse" data-target="#table-detail-1" class="d-style btn btn-outline-info text-90 text-600 border-0 px-2 collapsed" title="Show Details">
                                  <span class="d-none d-md-inline mr-1">
											Details
										</span>
                                <i class="fa fa-angle-down toggle-icon opacity-1 text-90"></i>
                            </a>
                        </div>
                    </td>

                    <td>
                        <!-- action buttons -->
                        <div class='d-none d-lg-flex'>
                            <a href="#" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                                <i class="fa fa-pencil-alt"></i>
                            </a>

                            <a href="#" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
                                <i class="fa fa-trash-alt"></i>
                            </a>
                            <a href="#" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-warning btn-a-lighter-warning">
                                <i class="fa fa-ellipsis-v mx-1"></i>
                            </a>
                        </div>

                        <!-- show a dropdown in mobile -->
                        <div class='dropdown d-inline-block d-lg-none dd-backdrop dd-backdrop-none-lg'>
                            <a href='#' class='btn btn-default btn-xs py-15 radius-round dropdown-toggle' data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </a>

                            <div class="dropdown-menu dd-slide-up dd-slide-none-lg">
                                <div class="dropdown-inner">
                                    <div class="dropdown-header text-100 text-secondary-d1 border-b-1 brc-secondary-l2 text-600 mb-2">
                                        base.com
                                    </div>
                                    <a href="#" class="dropdown-item">
                                        <i class="fa fa-pencil-alt text-blue mr-1 p-2 w-4"></i>
                                        Edit
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                        Delete
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="far fa-flag text-orange-d1 mr-1 p-2 w-4"></i>
                                        Flag
                                    </a>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>

                <!-- detail row -->
                <tr class="border-0 detail-row bgc-white">
                    <td colspan="8" class="p-0 border-none brc-secondary-l2">
                        <div class="table-detail collapse" id="table-detail-1">
                            <div class="row">
                                <div class="col-12 col-md-10 offset-md-1 p-4">
                                    <div class="alert bgc-secondary-l4 text-dark-m2 border-none border-l-4 brc-primary-m1 radius-0 mb-0">
                                        <h4 class="text-primary">
                                            Row Details
                                        </h4>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="bgc-h-yellow-l4 d-style">
                    <td class='text-center pr-0 pos-rel'>
                        <div class="position-tl h-100 ml-n1px border-l-4 brc-orange-m1 v-hover">
                            <!-- border shown on hover -->
                        </div>
                        <div class="position-tl h-100 ml-n1px border-l-4 brc-success-m1 v-active">
                            <!-- border shown when row is selected -->
                        </div>

                        <label>
                            <input type="checkbox" class="align-middle" />
                        </label>
                    </td>

                    <td>
                        <a href='#' class='text-blue-d1 text-600 text-95'>max.com</a>
                    </td>

                    <td class="text-600 text-orange-d2">
                        $60
                    </td>

                    <td class='d-none d-sm-table-cell text-grey-d1'>
                        4,400
                    </td>

                    <td class='d-none d-sm-table-cell text-grey text-95'>
                        Mar 11
                    </td>

                    <td class='d-none d-sm-table-cell'>



                        <span class='badge badge-sm bgc-info-d1 text-white pb-1 px-25'>Sold</span>
                    </td>

                    <td class='text-center pr-0'>
                        <div>
                            <a href="#" data-toggle="collapse" data-target="#table-detail-2" class="d-style btn btn-outline-info text-90 text-600 border-0 px-2 collapsed" title="Show Details">
                                  <span class="d-none d-md-inline mr-1">
											Details
										</span>
                                <i class="fa fa-angle-down toggle-icon opacity-1 text-90"></i>
                            </a>
                        </div>
                    </td>

                    <td>
                        <!-- action buttons -->
                        <div class='d-none d-lg-flex'>
                            <a href="#" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                                <i class="fa fa-pencil-alt"></i>
                            </a>

                            <a href="#" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
                                <i class="fa fa-trash-alt"></i>
                            </a>
                            <a href="#" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-warning btn-a-lighter-warning">
                                <i class="fa fa-ellipsis-v mx-1"></i>
                            </a>
                        </div>

                        <!-- show a dropdown in mobile -->
                        <div class='dropdown d-inline-block d-lg-none dd-backdrop dd-backdrop-none-lg'>
                            <a href='#' class='btn btn-default btn-xs py-15 radius-round dropdown-toggle' data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </a>

                            <div class="dropdown-menu dd-slide-up dd-slide-none-lg">
                                <div class="dropdown-inner">
                                    <div class="dropdown-header text-100 text-secondary-d1 border-b-1 brc-secondary-l2 text-600 mb-2">
                                        max.com
                                    </div>
                                    <a href="#" class="dropdown-item">
                                        <i class="fa fa-pencil-alt text-blue mr-1 p-2 w-4"></i>
                                        Edit
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                        Delete
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="far fa-flag text-orange-d1 mr-1 p-2 w-4"></i>
                                        Flag
                                    </a>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>

                <!-- detail row -->
                <tr class="border-0 detail-row bgc-white">
                    <td colspan="8" class="p-0 border-none brc-secondary-l2">
                        <div class="table-detail collapse" id="table-detail-2">
                            <div class="row">
                                <div class="col-12 col-md-10 offset-md-1 p-4">
                                    <div class="alert bgc-secondary-l4 text-dark-m2 border-none border-l-4 brc-primary-m1 radius-0 mb-0">
                                        <h4 class="text-primary">
                                            Row Details
                                        </h4>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="bgc-h-yellow-l4 d-style">
                    <td class='text-center pr-0 pos-rel'>
                        <div class="position-tl h-100 ml-n1px border-l-4 brc-orange-m1 v-hover">
                            <!-- border shown on hover -->
                        </div>
                        <div class="position-tl h-100 ml-n1px border-l-4 brc-success-m1 v-active">
                            <!-- border shown when row is selected -->
                        </div>

                        <label>
                            <input type="checkbox" class="align-middle" />
                        </label>
                    </td>

                    <td>
                        <a href='#' class='text-blue-d1 text-600 text-95'>best.com</a>
                    </td>

                    <td class="text-600 text-orange-d2">
                        $75
                    </td>

                    <td class='d-none d-sm-table-cell text-grey-d1'>
                        6,500
                    </td>

                    <td class='d-none d-sm-table-cell text-grey text-95'>
                        Apr 03
                    </td>

                    <td class='d-none d-sm-table-cell'>


                        <span class='badge badge-sm bgc-red-d1 text-white pb-1 px-25'>Flagged</span>

                    </td>

                    <td class='text-center pr-0'>
                        <div>
                            <a href="#" data-toggle="collapse" data-target="#table-detail-3" class="d-style btn btn-outline-info text-90 text-600 border-0 px-2 collapsed" title="Show Details">
                                  <span class="d-none d-md-inline mr-1">
											Details
										</span>
                                <i class="fa fa-angle-down toggle-icon opacity-1 text-90"></i>
                            </a>
                        </div>
                    </td>

                    <td>
                        <!-- action buttons -->
                        <div class='d-none d-lg-flex'>
                            <a href="#" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                                <i class="fa fa-pencil-alt"></i>
                            </a>

                            <a href="#" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
                                <i class="fa fa-trash-alt"></i>
                            </a>
                        </div>

                        <!-- show a dropdown in mobile -->
                        <div class='dropdown d-inline-block d-lg-none dd-backdrop dd-backdrop-none-lg'>
                            <a href='#' class='btn btn-default btn-xs py-15 radius-round dropdown-toggle' data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </a>

                            <div class="dropdown-menu dd-slide-up dd-slide-none-lg">
                                <div class="dropdown-inner">
                                    <div class="dropdown-header text-100 text-secondary-d1 border-b-1 brc-secondary-l2 text-600 mb-2">
                                        best.com
                                    </div>
                                    <a href="#" class="dropdown-item">
                                        <i class="fa fa-pencil-alt text-blue mr-1 p-2 w-4"></i>
                                        Edit
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                        Delete
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="far fa-flag text-orange-d1 mr-1 p-2 w-4"></i>
                                        Flag
                                    </a>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>

                <!-- detail row -->
                <tr class="border-0 detail-row bgc-white">
                    <td colspan="8" class="p-0 border-none brc-secondary-l2">
                        <div class="table-detail collapse" id="table-detail-3">
                            <div class="row">
                                <div class="col-12 col-md-10 offset-md-1 p-4">
                                    <div class="alert bgc-secondary-l4 text-dark-m2 border-none border-l-4 brc-primary-m1 radius-0 mb-0">
                                        <h4 class="text-primary">
                                            Row Details
                                        </h4>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="bgc-h-yellow-l4 d-style">
                    <td class='text-center pr-0 pos-rel'>
                        <div class="position-tl h-100 ml-n1px border-l-4 brc-orange-m1 v-hover">
                            <!-- border shown on hover -->
                        </div>
                        <div class="position-tl h-100 ml-n1px border-l-4 brc-success-m1 v-active">
                            <!-- border shown when row is selected -->
                        </div>

                        <label>
                            <input type="checkbox" class="align-middle" />
                        </label>
                    </td>

                    <td>
                        <a href='#' class='text-blue-d1 text-600 text-95'>pro.com</a>
                    </td>

                    <td class="text-600 text-orange-d2">
                        $55
                    </td>

                    <td class='d-none d-sm-table-cell text-grey-d1'>
                        4,250
                    </td>

                    <td class='d-none d-sm-table-cell text-grey text-95'>
                        Jan 21
                    </td>

                    <td class='d-none d-sm-table-cell'>

                        <span class='badge badge-sm bgc-green-d1 text-white pb-1 px-25'>Registered</span>


                    </td>

                    <td class='text-center pr-0'>
                        <div>
                            <a href="#" data-toggle="collapse" data-target="#table-detail-4" class="d-style btn btn-outline-info text-90 text-600 border-0 px-2 collapsed" title="Show Details">
                                  <span class="d-none d-md-inline mr-1">
											Details
										</span>
                                <i class="fa fa-angle-down toggle-icon opacity-1 text-90"></i>
                            </a>
                        </div>
                    </td>

                    <td>
                        <!-- action buttons -->
                        <div class='d-none d-lg-flex'>
                            <a href="#" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                                <i class="fa fa-pencil-alt"></i>
                            </a>

                            <a href="#" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
                                <i class="fa fa-trash-alt"></i>
                            </a>
                            <a href="#" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-warning btn-a-lighter-warning">
                                <i class="fa fa-ellipsis-v mx-1"></i>
                            </a>
                        </div>

                        <!-- show a dropdown in mobile -->
                        <div class='dropdown d-inline-block d-lg-none dd-backdrop dd-backdrop-none-lg'>
                            <a href='#' class='btn btn-default btn-xs py-15 radius-round dropdown-toggle' data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </a>

                            <div class="dropdown-menu dd-slide-up dd-slide-none-lg">
                                <div class="dropdown-inner">
                                    <div class="dropdown-header text-100 text-secondary-d1 border-b-1 brc-secondary-l2 text-600 mb-2">
                                        pro.com
                                    </div>
                                    <a href="#" class="dropdown-item">
                                        <i class="fa fa-pencil-alt text-blue mr-1 p-2 w-4"></i>
                                        Edit
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                        Delete
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="far fa-flag text-orange-d1 mr-1 p-2 w-4"></i>
                                        Flag
                                    </a>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>

                <!-- detail row -->
                <tr class="border-0 detail-row bgc-white">
                    <td colspan="8" class="p-0 border-none brc-secondary-l2">
                        <div class="table-detail collapse" id="table-detail-4">
                            <div class="row">
                                <div class="col-12 col-md-10 offset-md-1 p-4">
                                    <div class="alert bgc-secondary-l4 text-dark-m2 border-none border-l-4 brc-primary-m1 radius-0 mb-0">
                                        <h4 class="text-primary">
                                            Row Details
                                        </h4>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>













        </div>
    </div>

@endsection
