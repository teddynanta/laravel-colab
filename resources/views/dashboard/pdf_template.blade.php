a
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data PDF</title>
</head>

<body>
    <h1>List Berita Bulan {{ $bulan }}</h1>
    <h3>Total Berita : {{ $totalData }} Berita</h3>
    <div class="container">
        <table border="1" style="width: 100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Tanggal Post</th>
                    <th>Link</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($data as $record)
                    {{-- @dd($data); --}}
                    <tr>
                        <td align="center">{{ $i }}</td>
                        <td>{{ $record->title }}</td>
                        <td>{{ $record->category->nama }}</td>
                        <td align="center">{{ $record->tanggal_post }}</td>
                        <td><a
                                href="https://lubuklinggaukota.go.id/public/detilberita/{{ $record->id . '/' . $record->title }}">https://lubuklinggaukota.go.id/public/detilberita/{{ $record->id . '/' . $record->title }}</a>
                        </td>
                        <!-- Add more columns as needed -->
                    </tr>
                    @php
                        $i++;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    <h1>List Dokumen Bulan {{ $bulan }}</h1>
    <h3>Total Dokumen : {{ $totalDoc }} Dokumen</h3>
    <div class="container">
        <table border="1">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Tanggal Post</th>
                    <th>Link</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                @php
                    $j = 1;
                @endphp
                @foreach ($doc as $docs)
                    {{-- @dd($doc); --}}
                    <tr>
                        <td align="center">{{ $j }}</td>
                        <td>{{ $docs->judul }}</td>
                        <td>{{ $docs->category->nama }}</td>
                        <td align="center">{{ $docs->created_at }}</td>
                        <td><a
                                href="https://lubuklinggaukota.go.id/public/view-pdf/{{ $docs->id }}">https://lubuklinggaukota.go.id/public/view-pdf/{{ $docs->id }}</a>
                        </td>
                        <!-- Add more columns as needed -->
                    </tr>
                    @php
                        $j++;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
