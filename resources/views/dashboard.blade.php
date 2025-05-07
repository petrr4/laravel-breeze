<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="flex justify-end mb-4">
        <button onclick="toggleModal()" class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded">
             Tambah Mahasiswa
        </button>
        </div>
        <div id="addMahasiswaModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="relative w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
                <h2 class="mb-4 text-lg font-semibold">Tambah Mahasiswa</h2>
                <form action="{{ route('mahasiswa.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" id="nama" name="nama"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="nim"
                            class="block mb-2 text-sm font-medium text-gray-700">NIM</label>
                        <input type="text" id="nim" name="nim" pattern="\d{9}"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                            required>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="toggleModal()"
                            class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-400">Cancel</button>
                        <button type="submit"
                            class="px-4 py-2 text-white bg-blue-700 rounded hover:bg-blue-900">Save</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-700">No</th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-700">Nama</th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-700">NIM</th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($mahasiswa as $mhs)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{$mhs->nama}}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{$mhs->nim}}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">
                        <div class="flex space-x-2">
                        <button onclick="toggleModalUpdate({{$mhs->id}}, '{{$mhs->nama}}', '{{$mhs->nim}}')" class="text-2xl text-blue-500 hover:text-blue-700">
                            <i class="bi bi-pencil-square"></i>
                            </button>
                            <button onclick="toggleModalDelete({{$mhs->id}})" class="text-2xl text-red-500 hover:text-red-700">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </div>
                        <div id="updateModal{{$mhs->id}}" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50">
                            <div class="flex items-center justify-center min-h-screen px-4">
                                <div class="relative w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
                                    <h2 class="mb-4 text-lg font-semibold">Ubah Mahasiswa</h2>
                                    <form action="{{ route('mahasiswa.update', $mhs->id) }}" method="POST">
                                        @csrf
                                        @method('PUT') 
                                        <div class="mb-4">
                                            <label for="update_nama" class="block mb-2 text-sm font-medium text-gray-700">Nama</label>
                                            <input type="text" id="update_nama" name="nama"
                                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                                                required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="update_nim" class="block mb-2 text-sm font-medium text-gray-700">NIM</label>
                                            <input type="text" id="update_nim" name="nim" pattern="\d{9}"
                                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                                                required>
                                        </div>
                                        <div class="flex justify-end space-x-2">
                                            <button type="button" onclick="toggleModalUpdate({{$mhs->id}})"
                                                class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-400">Cancel</button>
                                            <button type="submit"
                                                class="px-4 py-2 text-white bg-blue-700 rounded hover:bg-blue-900">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <div id="deleteModal{{$mhs->id}}" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50">
                        <div class="flex items-center justify-center min-h-screen px-4">
                            <div class="relative w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
                                <h2 class="mb-4 text-lg font-semibold">Apakah anda yakin ingin menghapus data ini?</h2>
                                <div class="flex justify-end space-x-2">
                                    <button type="button" onclick="toggleModalDelete({{ $mhs->id }})"
                                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-400">Cancel</button>
                                    <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-700">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
<script>
    function toggleModal() {
    const modal = document.getElementById('addMahasiswaModal');
    modal.classList.toggle('hidden');
    }

    function toggleModalDelete(id) {
    const modalDelete = document.getElementById('deleteModal' + id);
    modalDelete.classList.toggle('hidden');
    }

    function toggleModalUpdate(id, nama = '', nim = ''){
        const modalUpdate = document.getElementById('updateModal' + id);
        if (!modalUpdate.classList.contains('hidden')) {
        modalUpdate.classList.add('hidden');
        return;
        }
        const form = modalUpdate.querySelector('form');
        modalUpdate.querySelector('#update_nama').value = nama;
        modalUpdate.querySelector('#update_nim').value = nim;

        modalUpdate.classList.remove('hidden');
    }

    @if (Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch (type) {
        case 'info':
            toastr.options.timeOut = 10000;
            toastr.info("{{ Session::get('message') }}");
            break;
        case 'success':
            toastr.options.timeOut = 10000;
            toastr.success("{{ Session::get('message') }}");
            break;
        case 'warning':
            toastr.options.timeOut = 10000;
            toastr.warning("{{ Session::get('message') }}");
            break;
        case 'error':
            toastr.options.timeOut = 10000;
            toastr.error("{{ Session::get('message') }}");
            break;
    }
@endif

    </script>
</x-app-layout>