<!-- filepath: /d:/ukk/todolist/resources/views/tes.blade.php -->
<div>
   prioritas  {{ $priority }}
   task  {{ $task_name }}
   deskripsi {{ $description }}
  deadline  {{ $due_date }}

</div>

<script>
   console.log( $('.badge-select').on('click', function() {
            $('.badge-select').removeClass('active');
            $(this).addClass('active');
            $('#priority').val($(this).data('value'));
        }););
    
</script>