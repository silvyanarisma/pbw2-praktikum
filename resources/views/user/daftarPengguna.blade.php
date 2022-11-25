<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Daftar Pengguna') }}
                </h2>
            </x-slot>

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel=" stylesheet">
            <!--Regular Datatables CSS-->
            <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
            <!--Responsive Extension Datatables CSS-->
            <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
            <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
            <!--Datatables -->
            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

            <style>
                /*Overrides for Tailwind CSS */

                /*Form fields*/
                .dataTables_wrapper select,
                .dataTables_wrapper .dataTables_filter input {
                    color: #4a5568;
                    /*text-gray-700*/
                    padding-left: 1rem;
                    /*pl-4*/
                    padding-right: 1rem;
                    /*pl-4*/
                    padding-top: .5rem;
                    /*pl-2*/
                    padding-bottom: .5rem;
                    /*pl-2*/
                    line-height: 1.25;
                    /*leading-tight*/
                    border-width: 2px;
                    /*border-2*/
                    border-radius: .25rem;
                    border-color: #edf2f7;
                    /*border-gray-200*/
                    background-color: #edf2f7;
                    /*bg-gray-200*/
                }

                /*Row Hover*/
                table.dataTable.hover tbody tr:hover,
                table.dataTable.display tbody tr:hover {
                    background-color: #ebf4ff;
                    /*bg-indigo-100*/
                }

                /*Pagination Buttons*/
                .dataTables_wrapper .dataTables_paginate .paginate_button {
                    font-weight: 700;
                    /*font-bold*/
                    border-radius: .25rem;
                    /*rounded*/
                    border: 1px solid transparent;
                    /*border border-transparent*/
                }

                /*Pagination Buttons - Current selected */
                .dataTables_wrapper .dataTables_paginate .paginate_button.current {
                    color: #fff !important;
                    /*text-white*/
                    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
                    /*shadow*/
                    font-weight: 700;
                    /*font-bold*/
                    border-radius: .25rem;
                    /*rounded*/
                    background: #667eea !important;
                    /*bg-indigo-500*/
                    border: 1px solid transparent;
                    /*border border-transparent*/
                }

                /*Pagination Buttons - Hover */
                .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
                    color: #fff !important;
                    /*text-white*/
                    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
                    /*shadow*/
                    font-weight: 700;
                    /*font-bold*/
                    border-radius: .25rem;
                    /*rounded*/
                    background: #667eea !important;
                    /*bg-indigo-500*/
                    border: 1px solid transparent;
                    /*border border-transparent*/
                }

                /*Add padding to bottom border */
                table.dataTable.no-footer {
                    border-bottom: 1px solid #e2e8f0;
                    /*border-b-1 border-gray-300*/
                    margin-top: 0.75em;
                    margin-bottom: 0.75em;
                }

                /*Change colour of responsive icon*/
                table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,
                table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
                    background-color: #667eea !important;
                    /*bg-indigo-500*/
                }
	        </style>


            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <script>
                        $(document).ready(function(){
                            $('#datatable').DataTable({
                                ajax:'{{url("getAllUsers")}}',
                                serverSide: false,
                                responsive:true,
                                processing: true,
                                deferRender: true,
                                type: 'GET',
                                destroy: true,
                                columns: [
                                    {data: 'id', name: 'id'},
                                    {data: 'fullname', name: 'fullname'},
                                    {data: 'email', name: 'email'},
                                    {data: 'username', name: 'username'},
                                    {data: 'address', name: 'address'},
                                    {data: 'phone_number', name: 'phone_number'},
                                    {data: 'birth_date', name: 'birth_date'},
                                    {data: 'action', name: 'action', orderable: false, searchable: false},
                                ]
                            }) 
                            .columns.adjust()
				            .responsive.recalc();
                        })
                    </script>
                    <body>
                        <div class="container-fluid">
                            <nav aria-label="breadcrumb" class="navbar navbar-expand-lg navbar-light">
                                <!-- <ol class="breadcrumb primary-color">
                                    <li class="breadcrumb-item">
                                        <a class="white-text" href="{{ url('/dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active">Daftar Koleksi</li>
                                </ol> -->
                            </nav>
                            <div class="row form-inline">
                                <x-primary-button class="mb-4 py-3 px-3">
                                    {{ __('Tambah Pengguna') }}
                                </x-primary-button>

                                <table class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Fullname</th>
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th>Address</th>
                                            <th>Phone Number</th>
                                            <th>Birth Date</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </body>
                </div>
            </div>    
        </div>
    </div>
</x-app-layout>