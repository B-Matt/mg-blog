@extends('layouts.dashboard')

@section('notification')
{!! \Session::get('notification') !!}
@endsection

@section('content')
<div class="d-sm-flex align-items-center mb-4">
    <h1 class="h3 mb-0 ml-1">Blog {{ __('main.categories') }}</h1>                    
</div>

<div class="container-fluid mb-5">
    <div class="row">    
        <div class="col-md-4 shadow bg-white">
            <div class="p-4">
                <h3>{{ __('main.category_new') }}</h3>
                <form class="bp-create-form mt-3" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf                    
                    <div class="form-group">
                        <label for="catName">{{ __('main.name') }}</label>
                        <input type="text" class="form-control" id="catName" name="name" placeholder="{{ __('main.category_name') }}" required />
                    </div>
                    <div class="form-group">
                        <label for="catSlug">{{ __('main.slug') }}</label>
                        <input type="text" class="form-control" id="catSlug" name="slug" placeholder="{{ __('main.category_slug') }}" required />
                    </div>
                    <div class="form-group">
                        <label for="catDesc">{{ __('main.description') }}</label>
                        <input type="text" class="form-control" id="catDesc" name="description" placeholder="{{ __('main.category_desc') }}" />
                    </div>
                    <div class="form-group">
                        <label for="catParent">{{ __('main.category_parent') }}</label>
                        <select class="form-control" id="catParent" name="parent" required>
                            <option selected="selected">None</option>
                            @if(isset($categories))
                                @foreach($categories as $category)
                                    <option>{{ $category->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="float-right py-3">
                        <button type="submit" class="btn btn-primary">{{ __('main.submit') }}</button>
                    </div>
                    {!! app('captcha')->render(); !!}
                </form>
            </div>
        </div>
        <div class="col ml-4 shadow bg-white">
            <div class="p-4">
                <h3>Categories</h3>
                <div class="table-wrapper-scroll-y dash-category-table mt-3">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="text-primary">{{ __('main.name') }}</th>
                            <th class="text-primary">{{ __('main.description') }}</th>
                            <th class="text-primary">{{ __('main.slug') }}</th>
                            <th class="text-primary">{{ __('main.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(isset($categories))
                                @foreach($categories as $category)
                                <tr>
                                    <td class="dash-category-editable">{{ $category->name }}</td>
                                    <td class="dash-category-editable">{{ $category->description }}</td>
                                    <td class="dash-category-editable">{{ $category->slug }}</td>
                                    <td class="d-inline-flex pt-1 dash-category-actions">
                                        <div class="dash-category-actions-static">
                                            <button type="submit" class="dash-category-edit btn btn-link p-0 mr-3" title="{{ __('main.category_edit') }}" category-data="{{ $category->id }}">
                                                <i class="dash-icon flaticon-pencil"></i>
                                            </button>
                                            <form method="post" action="{{ route('categories.destroy', $category) }}" class="m-0 w-50">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-link p-0" title="{{ __('main.category_delete') }}">
                                                    <i class="dash-icon flaticon-trash-bin"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>                                
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="{{ asset('/js/jquery.slim.min.js') }}"></script>

<script>
$(document).ready(() => { 

    // Generating Slugs
    /**
     * Returns slug from the given string.
     * @param str
     */
    function slug(str) {

        str = str.replace(/^\s+|\s+$/g, ''); // trim
        str = str.toLowerCase();

        // remove accents, swap ñ for n, etc
        var from = "ÁÄÂÀÃÅČÇĆĎÉĚËÈÊẼĔȆĞÍÌÎÏİŇÑÓÖÒÔÕØŘŔŠŞŤÚŮÜÙÛÝŸŽáäâàãåčçćďéěëèêẽĕȇğíìîïıňñóöòôõøðřŕšşťúůüùûýÿžþÞĐđßÆa·/_,:;";
        var to = "AAAAAACCCDEEEEEEEEGIIIIINNOOOOOORRSSTUUUUUYYZaaaaaacccdeeeeeeeegiiiiinnooooooorrsstuuuuuyyzbBDdBAa------";

        for (var i=0, l=from.length ; i<l ; i++) {
            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
        }

        str = str.replace(/[^a-z0-9 -]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
        return str;
    }

    $("#catName").on("input propertychange", () => {
        const name = $("#catName").val();
        $("#catSlug").val(slug(name));
    });

    // Edit table cells
    /**
     * Returns name of the input element based on index in array.
     * @param index
     */
    function getInputName(index) {
        if(index == 0) return "name";
        else if(index == 1) return "description";
        else if(index == 2) return "slug";
    }

    /**
     * Changes input values back to the ones saved in the oldData.
     * @param targets
     * @param oldData 
     */
    function revertInputValues(targets, oldData) {

        $(targets).each((i, element) => {
            $(element).find("input").val(oldData[i]);
        });
    }
    
    /**
     * Changes input values back to the regular text. 
     * @param targets
     */
    function transformInputs(targets) {

        $(targets).each((i, element) => {

            $(element).html($(element).find("input").val());
        });
    }

    /**
     * Shows information notification. 
     * @param text
     */
    function showNotification(text) {

        let notificationDiv = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' + text + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        $("#notifications").html(notificationDiv);
    }

    $(".dash-category-edit").click((e) => {

        let oldData = [];

        $(e.target).parents('tr').find('td.dash-category-editable').each((i, element) => {

            const value = $(element).html();
            const input = $('<input type="text" name="' + getInputName(i) + '" />');
            oldData.push(value);

            input.val(value);
            $(element).html(input);
            
        });

        const staticActions = $(e.currentTarget).parent();
        const finishButton = $('<button id="dash-category-finish" class="dash-category-edit btn btn-link p-0 mr-3" title="Finish editing category"><i class="dash-icon flaticon-pencil"></i></button>');
        $(e.target).parents('tr').find('td.dash-category-actions').append(finishButton);
        $(staticActions).toggle();
        const categoryId = $(e.currentTarget).attr('category-data');

        $(finishButton).click((e) => {

            let elements = $(e.target).parents('tr').find('td.dash-category-editable');
            let name = elements.find("input[name=name]").val();
            let description = elements.find("input[name=description]").val();
            let slug = elements.find("input[name=slug]").val();
            
            const putData = {
                "_token": "{{ csrf_token() }}",
                "id": categoryId,
                "name": name,
                "description": description,
                "slug": slug
            };

            if(oldData[2] == slug) {
                delete putData["slug"];
            }

            $.ajax({
                type: "PUT",
                url: "{{ route('categories.update', 8) }}",
                data: putData,
                success: (data) => {
                    
                    showNotification(data);
                    transformInputs(elements);
                },
                error: (data) => {

                    revertInputValues(elements, oldData);
                    transformInputs(elements);
                    showNotification("Error occured wile editing category. Try again with unique slug!");
                }
            });

            $(staticActions).toggle();
            $(finishButton).remove();
        });        
    });
});
</script>