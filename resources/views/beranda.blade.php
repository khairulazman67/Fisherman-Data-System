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
                    <p class="inline font-semibold">{{$jumlahtangkapan}} Kg</p>
                </div>
            </div>

            <div class="bg-primary-900 w-full rounded-xl shadow-lg shadow-gray-400 py-10 px-7 ">
                <h1 class="text-white font-semibold text-2xl">Boat Terdaftar</h1>
                <div class="w-auto h-[3px] bg-white rounded-xl mt-2"></div>
                <div class="text-white text-2xl mt-2">
                    <i class="fa-solid fa-ship"></i>
                    <p class="inline font-semibold">{{$jumlahboat}} Unit</p>
                </div>
            </div>
            <div class="bg-primary-900 w-full rounded-xl shadow-lg shadow-gray-400 py-10 px-7 ">
                <h1 class="text-white font-semibold text-2xl">Nelayan Terdaftar</h1>
                <div class="w-auto h-[3px] bg-white rounded-xl mt-2"></div>
                <div class="text-white text-2xl mt-2">
                    <i class="fa-solid fa-users inline"></i>
                    <p class="inline font-semibold">{{$jumlahnelayan}}</p>
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
            {{-- Message --}}
            @if (session()->has('success'))
                <div class="flex justify-between mx-2 my-2 bg-green-600 text-white rounded-lg h-10 text-lg px-5">
                    <p class="my-auto">{{session()->get('success')}}</p>
                    <i class="my-auto hover:text-gray-600 fas fa-times alert-del"></i>
                </div>
            @elseif (session()->has('failed'))
                <div class="flex justify-between mx-2 my-2 bg-red-500 text-white rounded-lg h-10 text-lg px-5">
                    <p class="my-auto">{{session()->get('failed')}}</p>
                    <i class="my-auto hover:text-gray-600 fas fa-times alert-del"></i>
                </div>
            @endif
            
            <div class="my-5 pb-5 flex flex-col justify-center">
                <div class="flex justify-center">
                    <form action="{{url('tambahtangkapan')}}" method="post" class="w-full max-w-2xl">
                        @csrf
                        <div class="flex -mx-4 mb-2">
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-state">
                                    Boat
                                </label>
                                <div class="relative">
                                    <select name="id_boat"
                                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="grid-state" required>
                                        <option value="">Pilih Boat</option>
                                        @foreach ($boat as $i=>$dat)
                                            <option value="{{$dat->id}}">{{$dat->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-city">
                                    Jenis Ikan
                                </label>
                                <input type="text" name="tangkapan"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-city" type="text" placeholder="Ikan Tongkol" required> 
                            </div>
                            
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-zip">
                                    Jumlah
                                </label>
                                <input type="number" name="jumlah"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-zip" type="text" placeholder="100 Kg" required>
                            </div>
                            <div class="w-full md:w-1/3 px-3 mt-6">
                                <button   type="submit"
                                    class="bg-emerald-500 text-white hover:bg-emerald-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-3 text-center "
                                    >
                                    Simpan Data
                                </button>
                            </div>
                            
                        </div>
                    </form>
                </div>
                <div class="flex justify-center mx-auto mt-3">
                    <div class="w-full">
                        <div class="border-b border-gray-200 shadow ">
                            <table class="divide-y divide-gray-300 ">
                                <thead class="bg-gray-900 text-white rounded-xl">
                                    <tr>
                                        <th class="px-6 py-2 ">
                                            No
                                        </th>
                                        <th class="px-20 py-2 ">
                                            Boat
                                        </th>
                                        <th class="px-10 py-2 ">
                                            Tangkapan
                                        </th>
                                        <th class="px-10 py-2 ">
                                            Jumlah Ikan
                                        </th>
                                        <th class="px-16 py-2">
                                            Tanggal
                                        </th>
                                        <th class="px-10 py-2">
                                            Jam
                                        </th>
                                        <th class="px-10 py-2">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-300 text-black">
                                    <?php $j = ($data->currentpage()-1)* $data->perpage() + 1;?>
                                    @foreach ($data as $i=>$dat)
                                    <tr class="whitespace-nowrap">
                                        <td class="px-6 py-4">
                                            {{$j++}}
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
                                            {{$hari.', '.$tanggal}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$dat->created_at->format('h:i:s A')}}
                                        </td>
                                        <td class="flex px-6 py-4">
                                            <button
                                                class="px-6 py-1 text-sm text-white bg-yellow-400 hover:bg-yellow-500 rounded-lg"
                                                type="button" onclick="toggleModal('modal-edit')" id="edit"
                                                data-target="#modal-edit" data-whatever="@mdo" 
                                                data-id="{{$dat->id}}"
                                                data-id_boat="{{$dat->id_boat}}" 
                                                data-tangkapan="{{$dat->jenis_ikan}}"
                                                data-jumlah_ikan="{{$dat->banyak}}"
                                                >
                                                Edit
                                            </button>
                                            {{-- </form> --}}
                                            <form action="{{url('tangkapan/'.$dat->id)}}" method="post"
                                                onsubmit="return confirm('Apakah anda ingin melanjutkan penghapusan data?')">
                                                @method('delete')
                                                @csrf
                                                <button
                                                    class="px-6 py-1 text-sm text-white bg-red-700 ml-2 hover:bg-red-800 rounded-lg">Hapus</button>
                                            </form>
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
        <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" 
        id="modal-edit">
            <div class="relative w-auto my-6 mx-auto max-w-3xl">
                <!--content-->
                <div
                    class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                    <!--header-->
                    <div class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
                        <h3 class="text-3xl font-semibold">
                            Edit Boat
                        </h3>
                        <button
                            class="p-1 ml-auto border-0 text-black float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
                            onclick="toggleModal('modal-edit')">
                            <span class="text-red-500 h-6 w-6 text-2xl block outline-none focus:outline-none">
                                x
                            </span>
                        </button>
                    </div>
                    
                    <!--body-->
                    <form action="/edittangkapan" method="post">
                        @csrf
                        <div class="relative p-6 flex-auto">
                            {{-- <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0"> --}}
                                <input type="hidden" name="id" id="id" value="id">
                            
                            <div class=" mb-5">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-state">
                                    Boat
                                </label>
                                <div class="relative">
                                    <select name="id_boat"
                                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="grid-state">
                                        @foreach ($boat as $i=>$dat)
                                            <option value="{{$dat->id}}">{{$dat->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            

                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="tangkapan" id="tangkapan" value="tangkapan"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-primary-900 peer"
                                    placeholder=" " required />
                                <label
                                    class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0  peer-focus:text-primary-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Tangkapan</label>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="number" name="jumlah_ikan" id="jumlah_ikan" value="jumlah_ikan"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary-900 peer"
                                    placeholder=" " required />
                                <label
                                    class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0  peer-focus:text-primary-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Jumlah Ikan</label>
                            </div>

                        </div>
                        <!--footer-->
                        <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
                            <button
                                class="bg-red-500 text-white hover:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                type="button" onclick="toggleModal('modal-edit')">
                                Tutup
                            </button>
                            <button
                                class="bg-emerald-500 text-white hover:bg-emerald-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                type="submit" onclick="toggleModal('modal-edit')">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-edit-backdrop"></div>

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

            function toggleModal(modalID) {
                document.getElementById(modalID).classList.toggle("hidden");
                document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
                document.getElementById(modalID).classList.toggle("flex");
                document.getElementById(modalID + "-backdrop").classList.toggle("flex");
            }
            $(document).ready(function () {
                var id = null;
                var id_boat = null;
                var tangkapan = null;
                var jumlah_ikan = null;
                
                $(document).on('click', '#edit', function () {
                    this.id = $(this).data('id');
                    this.id_boat = $(this).data('id_boat');
                    this.tangkapan = $(this).data('tangkapan');
                    this.jumlah_ikan = $(this).data('jumlah_ikan');
                    console.log('nama kapal', this.nama_pemilik)

                    $('#id').val(this.id);
                    $('#id_boat').val(this.id_boat);
                    $('#tangkapan').val(this.tangkapan);
                    $('#jumlah_ikan').val(this.jumlah_ikan);
                })
            });

        </script>
    </div>
    @endsection
