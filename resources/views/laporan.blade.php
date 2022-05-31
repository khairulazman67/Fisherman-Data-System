@extends('../layouts/admin_layout')
@section('title', 'Detail Mahasiswa')
@section('content')

<body>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js"
        integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });

    </script>
    <div class="container mx-auto mb-10">
        <!-- tulisan atas -->
        <div class="w-full  relative">
            <div class="mt-4">
                <div class="flex justify-center text-white font-bold text-4xl bg-secondary-900 rounded-3xl  mb-5 py-3">
                    Laporan Hasil Tangkapan Nelayan
                </div>
            </div>
            <div class="bg-primary-700 h-2 "></div>
        </div>
        

        <div class="w-full h-auto shadow-xl shadow-gray-400 mt-10 rounded-xl">
            <div class="bg-secondary-900 rounded-t-xl px-10 py-3">
                <h1 class="font-bold text-white text-xl">Data Nelayan </h1>
            </div>
            {{-- Message --}}
            @if (session()->has('successn'))
            <div class="flex justify-between mx-2 my-2 bg-green-600 text-white rounded-lg h-10 text-lg px-5">
                <p class="my-auto">{{session()->get('successn')}}</p>
                <i class="my-auto hover:text-gray-600 fas fa-times alert-del"></i>
            </div>
            @elseif (session()->has('failedn'))
            <div class="flex justify-between mx-2 my-2 bg-red-500 text-white rounded-lg h-10 text-lg px-5">
                <p class="my-auto">{{session()->get('failedn')}}</p>
                <i class="my-auto hover:text-gray-600 fas fa-times alert-del"></i>
            </div>
            @endif
            <?php
                function tgl_indo($tanggal){
                    $bulan = array (
                        1 =>   'Januari',
                        'Februari',
                        'Maret',
                        'April',
                        'Mei',
                        'Juni',
                        'Juli',
                        'Agustus',
                        'September',
                        'Oktober',
                        'November',
                        'Desember'
                    );
                    $pecahkan = explode('-', $tanggal);
                    
                    // variabel pecahkan 0 = tanggal
                    // variabel pecahkan 1 = bulan
                    // variabel pecahkan 2 = tahun
                    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                }
                function hari($hari){
                    switch($hari){
                        case 'Sun':
                            $hari_ini = "Minggu";
                        break;
                        case 'Mon':			
                            $hari_ini = "Senin";
                        break;
                        case 'Tue':
                            $hari_ini = "Selasa";
                        break;
                        case 'Wed':
                            $hari_ini = "Rabu";
                        break;
                        case 'Thu':
                            $hari_ini = "Kamis";
                        break;
                        case 'Fri':
                            $hari_ini = "Jumat";
                        break;
                        case 'Sat':
                            $hari_ini = "Sabtu";
                        break;
                        default:
                            $hari_ini = "Tidak di ketahui";		
                        break;
                    }
                    return  $hari_ini ;
                }
            ?>
            <div class="my-5 pb-5 flex justify-center mx-auto">
                <div class="flex flex-row">
                    <div>
                        <div class="border-b border-gray-200 shadow ">
                            <table class="divide-y divide-gray-300 ">
                                <thead class="bg-gray-900 text-white rounded-xl">
                                    <tr>
                                        <th class="px-4 py-2 ">
                                            No
                                        </th>
                                        <th class="px-15 py-2">
                                            Nama Boat
                                        </th>
                                        <th class="px-10 py-2 ">
                                            Jenis Tangkapan
                                        </th>
                                        <th class="px-10 py-2">
                                            Jumlah
                                        </th>
                                        <th class="px-10 py-2">
                                            Tanggal
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-300 text-black">
                                    @foreach ($tangkapan as $i=>$dat)
                                        <tr class="whitespace-nowrap">
                                            <td class="px-6 py-4">
                                                {{$i+1}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$dat->boat->nama}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$dat->jenis_ikan}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$dat->banyak}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{hari($dat->created_at->format('D'))}}, {{tgl_indo($dat->created_at->format('Y-m-d'))}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-edit-backdrop"></div>
        <script type="text/javascript">
            function toggleModal(modalID) {
                document.getElementById(modalID).classList.toggle("hidden");
                document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
                document.getElementById(modalID).classList.toggle("flex");
                document.getElementById(modalID + "-backdrop").classList.toggle("flex");
            }

            var alert_del = document.querySelectorAll('.alert-del');
            alert_del.forEach((x) =>
                x.addEventListener('click', function () {
                    x.parentElement.classList.add('hidden');
                })
            );

            $(document).ready(function () {
                var id = null;
                var nama_pemilik = null;
                var nama_kapal = null;
                
                $(document).on('click', '#edit', function () {
                    this.id = $(this).data('id');
                    this.nama_kapal = $(this).data('nama_kapal');
                    this.nama_pemilik = $(this).data('nama_pemilik');
                    console.log('nama kapal', this.nama_pemilik)

                    $('#id').val(this.id);
                    $('#nama_kapal').val(this.nama_kapal);
                    $('#nama_pemilik').val(this.nama_pemilik);
                })
            });
            // var modaledit = document.getElementById('editData');

        </script>
    </div>
    @endsection
