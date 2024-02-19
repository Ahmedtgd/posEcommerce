FilePond.setOptions({
    server: {
        process: {
            url: '/upload',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }
    }
});
