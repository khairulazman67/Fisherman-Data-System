@extends('../layouts/admin_layout')
@section('title', 'Detail Mahasiswa')
@section('content')

<body>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
    <div class="container mx-auto mb-10">
        <!-- tulisan atas -->
        <div class="w-full  relative">
            <div class="mt-4">
                <div class="flex justify-center text-white font-bold text-4xl bg-secondary-900 rounded-3xl  mb-5 py-3">
                    Sistem Pendataan Nelayan
                </div>
            </div>
            <div class="bg-primary-700 h-2 "></div>
        </div>
        <!-- info -->
        <div class="flex justify-center h-40 mt-4 grid-rows-1 grid-flow-col gap-5 text-center my-10">
            <div class="bg-primary-900 w-full rounded-xl shadow-lg shadow-gray-400 py-10 px-7 ">
                <h1 class="text-white font-semibold text-2xl">Tangkapan Hari ini</h1>
                <div class="w-auto h-[3px] bg-white rounded-xl mt-2"></div>
                <div class="text-white text-2xl mt-2">
                    <i class="fa-solid fa-fish-fins"></i>
                    <p class="inline font-semibold">{{$jumlah}} Kg</p>
                </div>
            </div>

            <div class="bg-primary-900 w-full rounded-xl shadow-lg shadow-gray-400 py-10 px-7 ">
                <h1 class="text-white font-semibold text-2xl">Boat Terdaftar</h1>
                <div class="w-auto h-[3px] bg-white rounded-xl mt-2"></div>
                <div class="text-white text-2xl mt-2">
                    <i class="fa-solid fa-ship"></i>
                    <p class="inline font-semibold">{{$jumlah}} Unit</p>
                </div>
            </div>
            <div class="bg-primary-900 w-full rounded-xl shadow-lg shadow-gray-400 py-10 px-7 ">
                <h1 class="text-white font-semibold text-2xl">Nelayan Terdaftar</h1>
                <div class="w-auto h-[3px] bg-white rounded-xl mt-2"></div>
                <div class="text-white text-2xl mt-2">
                    <i class="fa-solid fa-users inline"></i>
                    <p class="inline font-semibold">{{$jumlah}}</p>
                </div>
            </div>
            <div class="bg-primary-800 w-full rounded-xl shadow-lg shadow-gray-400 py-10 px-7 text-lg ">
                <div class="text-white font-semibold text-2xl">
                    <div id="tanggal"></div>
                </div>
                <div class="w-auto h-[3px] bg-white rounded-xl mt-2"></div>
                <div class="text-white text-2xl mt-2 font-bold">
                    <div id="jam"></div>
                </div>
            </div>
        </div>

        <!-- table -->
        <div class="w-full h-auto shadow-xl shadow-gray-400 mt-10 rounded-xl">
            <div class="bg-secondary-900 rounded-t-xl px-10 py-3">
                <h1 class="font-bold text-white text-xl">Data Tangkapan Ikan</h1>
            </div>

            
            <div class="my-5 pb-5 flex justify-center mx-auto">
                <div class="flex flex-col">
                    <div class="w-full">
                        <div class="border-b border-gray-200 shadow ">
                            <table class="divide-y divide-gray-300 ">
                                <thead class="bg-gray-900 text-white rounded-xl">
                                    <tr>
                                        <th class="px-6 py-2 text-lg ">
                                            No
                                        </th>
                                        <th class="px-20 py-2 text-lg">
                                            Boat
                                        </th>
                                        <th class="px-10 py-2 text-lg ">
                                            Tangkapan
                                        </th>
                                        <th class="px-10 py-2 text-lg ">
                                            Jumlah Ikan
                                        </th>
                                        <th class="px-16 py-2 text-lg ">
                                            Tanggal
                                        </th>
                                        <th class="px-10 py-2 text-lg ">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-300 text-black">
                                    <?php $j = ($data->currentpage()-1)* $data->perpage() + 1;?>
                                    @foreach ($data as $i=>$dat)
                                    <tr class="whitespace-nowrap">
                                        <td class="px-6 py-4 text-xl">
                                            {{$j++}}
                                        </td>   
                                        <td class="px-6 py-4 text-xl">
                                            {{$dat->boat->nama}}
                                        </td>
                                        <td class="px-6 py-4 text-xl">
                                            {{$dat->jenis_ikan}}
                                        </td>
                                        <td class="px-6 py-4 text-xl">
                                            {{$dat->banyak}}
                                        </td>
                                        <td class="px-6 py-4 text-xl">
                                            {{$hari.', '.$tanggal}}
                                        </td>
                                        <td class="px-6 py-4 text-xl">
                                            {{$dat->created_at->format('h:i:s A')}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $data->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>   
            </div>
        </div>
        <script>
            window.setTimeout("waktu()", 1000);

            function waktu() {
                var waktu = new Date();
                setTimeout("waktu()", 1000);
                document.getElementById("jam").innerHTML = waktu.getHours() + ":" + waktu.getMinutes() + ":" + waktu
                    .getSeconds();
            }
            window.setTimeout("tanggal()");

            function tanggal() {
                var tanggallengkap = new String();
                var namahari = ("Minggu Senin Selasa Rabu Kamis Jumat Sabtu");
                namahari = namahari.split(" ");
                var namabulan = (
                    "Januari Februari Maret April Mei Juni Juli Agustus September Oktober November Desember");
                namabulan = namabulan.split(" ");
                var tgl = new Date();
                var hari = tgl.getDay();
                var tanggal = tgl.getDate();
                var bulan = tgl.getMonth();
                var tahun = tgl.getFullYear();
                tanggallengkap = namahari[hari] + ", " + tanggal + " " + namabulan[bulan] + " " + tahun;
                document.getElementById("tanggal").innerHTML = tanggallengkap
            }
            var alert_del = document.querySelectorAll('.alert-del');
            alert_del.forEach((x) =>
                x.addEventListener('click', function () {
                    x.parentElement.classList.add('hidden');
                })
            );
        </script>
    </div>
@endsection

