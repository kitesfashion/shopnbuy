@extends('admin.layouts.master')

@section('content')
<?php
    use App\Article;
?>
<div class="row">
    <div class="col-md-3">
        <h5><strong>Search By Parent Article</strong></h5>
        <form>
            <select name="parentArticleParam" class="form-control chosen-select parentArticle">
                    <option value="">View All</option>
                @foreach ($parentArticleList as $parentArticle)
                   @php
                        if(@$parentArticleParam){
                            if($parentArticle->id == $parentArticleParam){
                                $selected = 'selected';
                            }else{
                                $selected = '';
                            }
                        }
                        $getArticle = Article::where('parentArticle',$parentArticle->id)->get();
                        if($parentArticle->parentArticle == NULL OR count($getArticle) > 0){
                   @endphp
                    <option {{@$selected}} value="{{$parentArticle->id}}">{{$parentArticle->articleName}}
                    </option>
                    @php
                        }
                    @endphp
                @endforeach
            </select>
        </form>
    </div>
</div>
<div class="table-responsive">
    <table id="articles" class="table table-bordered table-striped datatable"  name="articles">
        <thead>
            <tr>
                <th width="5%">SL</th>
                <th>Name</th>
                <th width="18%">Title</th>
                <th width="18%">Parent Article</th>
                <th width="12%">Home Image</th>
                <th width="12%">Inner Image</th>
                <th width="5%">Order</th>
                <th width="5%">Status</th>
                <th width="5%">Action</th>
            </tr>
        </thead>
        <tbody id="tbody">
            <?php $i = 0; ?>
        	@foreach($articles as $article)
            <?php 
                $i++;
                $parentArticle = Article::where('id',$article->parentArticle)->first();
                if(@$parentArticle){
                    $parentArticleName = $parentArticle->articleName;
                }else{
                    $parentArticleName = '';
                }

                if($article->firstHomeTitle){
                    $articleTitle = $article->firstHomeTitle;
                }else{
                    $articleTitle = $article->firstInnerTitle;
                }
            ?>                        	
        	<tr class="row_{{$article->id}}">
                <td>{{ $i }}</td>
                 <td>{{$article->articleName}}</td>
                 <td>{{@$articleTitle}}</td>
                 <td>{{$parentArticleName}}</td>
                 <td>
                     <?php if (file_exists(@$article->firstHomeImage)) { ?> 
                        <img src="{{asset('/').@$article->firstHomeImage}}" style="height: 40px;">
                    <?php }else{ ?>
                        <img src="{{$noImage}}" style="height: 40px;">
                    <?php } ?>
                 </td>
                 <td>
                     <?php if (file_exists(@$article->firstInnerImage)) { ?> 
                        <img src="{{asset('/').@$article->firstInnerImage}}" style="height: 40px;">
                    <?php }else{ ?>
                        <img src="{{$noImage}}" style="height: 40px;">
                    <?php } ?>
                 </td>
                 <td class="text-center">{{$article->orderBy}}</td>
                 <td>
                    <?php echo \App\Link::status($article->id,$article->articleStatus)?>
                </td>
                <td class="text-nowrap">
                    <?php echo \App\Link::action($article->id)?>
                </td>
            </tr>
        	@endforeach
        </tbody>
    </table>
</div>
            
@endsection

@section('custom-js')

<script>
    $(document).ready(function() {
        var updateThis ;

        //ajax delete code
        $('#articles tbody').on( 'click', 'i.fa-trash', function () {
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            articleId = $(this).parent().data('id');
            swal({   
                title: "Are you sure?",   
                text: "You will not be able to recover this imaginary file!",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Yes, delete it!",   
                cancelButtonText: "No, cancel plx!",   
                closeOnConfirm: false,   
                closeOnCancel: false 
            }, function(isConfirm){   
                if (isConfirm) {     
                   $.ajax({
                        type: "POST",
                        url : "{{ route('articles.delete',0) }}",
                        data : {articleId:articleId},
                        success: function(response) {
                            swal({
                                title: "<small class='text-success'>Success!</small>", 
                                type: "success",
                                text: "Article Deleted Successfully!",
                                timer: 1000,
                                html: true,
                            });
                            $('.row_'+articleId).remove();
                        },
                        error: function(response) {
                            error = "Failed.";
                            swal({
                                title: "<small class='text-danger'>Error!</small>", 
                                type: "error",
                                text: error,
                                timer: 1000,
                                html: true,
                            });
                        }
                    });    
                } else { 
                    swal({
                        title: "Cancelled", 
                        type: "error",
                        text: "Your article is safe :)",
                        timer: 1000,
                        html: true,
                    });    
                } 
            });
        }); 

    });
            
    //ajax status change code
    function statusChange(articleId) {
        $.ajax({
                type: "GET",
                url: "{{ route('articles.status', 0) }}",
                data: "articleId=" + articleId,
                cache:false,
                contentType: false,
                processData: false,
                success: function(response) {
                    swal({
                        title: "<small class='text-success'>Success!</small>", 
                        type: "success",
                        text: "Status successfully updated!",
                        timer: 1000,
                        html: true,
                    });
                },
                error: function(response) {
                    error = "Failed.";
                    swal({
                        title: "<small class='text-danger'>Error!</small>", 
                        type: "error",
                        text: error,
                        timer: 2000,
                        html: true,
                    });
                }
            });
        }
</script>

<script type="text/javascript">
    $('.parentArticle').on('change', function(){
      var parentArticle = $('.parentArticle').val();
      window.location.href = "{{route('articles.index')}}"+"?parentArticle="+parentArticle;
    }); 
</script>

@endsection


