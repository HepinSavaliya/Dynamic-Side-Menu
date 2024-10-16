<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 20px;
            }
            #menuList {
                list-style-type: none;
                padding: 0;
                margin: 0;
                width: 300px;
            }
            .sortable-item {
                background-color: #fff;
                margin: 5px 0;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 4px;
                cursor: move;
                position: relative;
                transition: background-color 0.3s;
            }
            .sortable-item:hover {
                background-color: #f0f0f0;
            }
            .sortable {
                margin-left: 20px;
            }
            .ui-state-highlight {
                height: 40px;
                background-color: #e9e9e9;
                border: 2px dashed #ccc;
                border-radius: 4px;
            }
            .dragging {
                opacity: 0.5;
                transform: scale(1.05);
            }
            .drop-over {
                border: 2px dashed #007bff;
                background-color: #e8f0fe;
            }
            .child-drop-over {
                border: 2px dashed #28a745;
                background-color: #e8f9ea;
            }
    </style>
    <title>{{ env('APP_NAME','') }}</title>
</head>

<body>

    <ul id="menuList" class="sortable ui-sortable">
        @include('sidemenu.sort_child', ['menuTree' => $menuTree])
    </ul>


    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $(document).ready(function() {
            $('.sortable').sortable({
                items: 'li.sortable-item', // Only make the li elements sortable, not ul elements
                connectWith: '.sortable', // Allow sorting within and between sortable lists
                helper: 'clone', // Clone the item when dragging (so it doesn't move its children)
                placeholder: "ui-state-highlight",
                update: function(event, ui) {
                    let menuStructure = [];

                    // Loop through each list item to build the updated menu structure
                    $('#menuList li').each(function(index) {
                        let menuId = $(this).data('id');
                        let parentId = $(this).closest('ul').parent('li').data('id') || '';

                        menuStructure.push({
                            menu_id: menuId,
                            parent_menu_id: parentId,
                            order: index
                        });
                    });

                    // Send the new structure to the server
                    $.ajax({
                        url: '{{ route(config('sidemenu.route_name')) }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            menuStructure: menuStructure
                        },
                        success: function (response) {
                            console.log(response)
                        }
                    });
                }
            }).disableSelection();
        });
    </script>
</body>

</html>
