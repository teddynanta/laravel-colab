<?php
@dd($paginatedData);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>API Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Kode Indikator</th>
                <th scope="col">Uraian Indikator</th>
                <th scope="col">Tahun</th>
                <th scope="col">Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paginatedData as $item)
                <tr>
                    <th scope="row">{{ $item['rownum'] }}</th>
                    <td>{{ $item['kodeindikator'] }}</td>
                    <td>{{ $item['uraian_indikator'] }}</td>
                    <td>{{ $item['tahun'] }}</td>
                    <td>{{ $item['data'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mx-auto">
        {{ $paginatedData->links() }}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
