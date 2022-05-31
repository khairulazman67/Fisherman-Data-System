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
        <!-- table -->
        <div class="w-full h-auto shadow-xl shadow-gray-400 mt-5 rounded-xl">
            <div class="bg-secondary-900 rounded-t-xl px-10 py-3">
                <h1 class="font-bold text-white text-xl">Data Boat </h1>
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

            <div class="my-5 pb-5 flex justify-center mx-auto">
                <div class="flex flex-row">
                    <div class="mr-5 w-60">
                        <div class="text-xl font-bold">
                            Tambah Data Boat
                        </div>
                        <form class="mt-4" action="/tambahboat" method="post">
                            @csrf
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="nama_boat"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary-900 peer"
                                    placeholder=" " required />
                                <label
                                    class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0  peer-focus:text-primary-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nama
                                    Boat</label>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="nama_pemilik"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-primary-900 peer"
                                    placeholder=" " required />
                                <label
                                    class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0  peer-focus:text-primary-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nama
                                    Pemilik</label>
                            </div>
                            <button type="submit"
                                class="bg-emerald-500 text-white hover:bg-emerald-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">
                                Simpan Data</button>
                        </form>
                    </div>
                    <div>
                        <div class="border-b border-gray-200 shadow ">
                            <table class="divide-y divide-gray-300 ">
                                <thead class="bg-gray-900 text-white rounded-xl">
                                    <tr>
                                        <th class="px-6 py-2 text-lg ">
                                            No
                                        </th>
                                        <th class="px-20 py-2 text-lg">
                                            Nama Boat
                                        </th>
                                        <th class="px-10 py-2 text-lg ">
                                            Pemilik
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
                                            {{$dat->nama}}
                                        </td>
                                        <td class="px-6 py-4 text-xl">
                                            {{$dat->pemilik}}
                                        </td>
                                        <td class="flex px-6 py-4">
                                            <button
                                                class="px-6 py-1 text-sm text-white bg-yellow-400 hover:bg-yellow-500 rounded-lg"
                                                type="button" onclick="toggleModal('modal-edit')" id="edit"
                                                data-target="#modal-edit" data-whatever="@mdo" 
                                                data-id="{{$dat->id}}"
                                                data-nama_kapal="{{$dat->nama}}" data-nama_pemilik="{{$dat->pemilik}}">
                                                Edit
                                            </button>
                                            {{-- </form> --}}
                                            <form action="{{url('boat/'.$dat->id)}}" method="post"
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

            <div class="my-5 pb-5 flex justify-center mx-auto">
                <div class="flex flex-row">
                    <div class="mr-5 w-80">
                        <div class="text-xl font-bold">
                            Tambah Data Nelayan
                        </div>
                        <form action="/tambahdatanelayan" method="post">
                            @csrf
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="nama_nelayan"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary-900 peer"
                                    placeholder=" " required />
                                <label
                                    class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0  peer-focus:text-primary-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Nama</label>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="alamat"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-primary-900 peer"
                                    placeholder=" " required />
                                <label
                                    class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0  peer-focus:text-primary-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Alamat</label>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="number" name="no_hp" id="floating_last_name"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary-800 peer"
                                    placeholder=" " required />
                                <label for="floating_last_name"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-primary-800  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    No HP</label>
                                
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <label for="countries" class="block mb-2 text-sm  text-gray-500 ">
                                    Kapal
                                </label>
                                <select name="id_boat" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="null" selected>Pilih Boat</option>
                                    @foreach ($boat as $i=>$dat)
                                        <option value="{{$dat->id}}">{{$dat->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit"
                                class="bg-emerald-500 text-white hover:bg-emerald-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                                Simpan Data
                            </button>
                        </form>
                    </div>
                    <div>
                        <div class="border-b border-gray-200 shadow ">
                            <table class="divide-y divide-gray-300 ">
                                <thead class="bg-gray-900 text-white rounded-xl">
                                    <tr>
                                        <th class="px-4 py-2 ">
                                            No
                                        </th>
                                        <th class="px-15 py-2">
                                            Nama
                                        </th>
                                        <th class="px-10 py-2 ">
                                            Nama Boat
                                        </th>
                                        <th class="px-10 py-2">
                                            Alamat
                                        </th>
                                        <th class="px-10 py-2">
                                            No HP
                                        </th>
                                        <th class="px-10 py-2">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-300 text-black">
                                    <?php $j = ($nelayan->currentpage()-1)* $data->perpage() + 1;?>
                                    @foreach ($nelayan as $i=>$dat)
                                        <tr class="whitespace-nowrap">
                                            <td class="px-6 py-4">
                                                {{$j++}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$dat->nama}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$dat->boat->nama}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$dat->alamat}}
                                            </td>
                                            <td class="px-6 py-4">
                                                0{{$dat->no_hp}}
                                            </td>
                                            <td class="flex px-6 py-4">
                                                <form action="{{url('editnelayan/'.$dat->id)}}" method="post">
                                                    @csrf
                                                    <button
                                                        class="px-6 py-1 text-sm text-white bg-yellow-400 hover:bg-yellow-500 rounded-lg">Edit</button>
                                                </form>
                                                
                                                {{-- </form> --}}
                                                <form action="{{url('nelayan/'.$dat->id)}}" method="post"
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

        <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-edit">
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
                    <form action="/editboat" method="post">
                        <div class="relative p-6 flex-auto">

                            @csrf
                            <input type="hidden" name="id" id="id" value="id">
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="nama_boat" id="nama_kapal" value="nama_kapal"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary-900 peer"
                                    placeholder=" " required />
                                <label
                                    class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0  peer-focus:text-primary-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nama
                                    Boat</label>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="nama_pemilik" id="nama_pemilik" value="nama_pemilik"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-primary-900 peer"
                                    placeholder=" " required />
                                <label
                                    class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0  peer-focus:text-primary-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nama
                                    Pemilik</label>
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
