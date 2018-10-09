<div class="wrap t201plugin">
    <h2>Client Categories</h2>

    <div id="message" class="updated below-h2 ct-msg ct_success_msg">
        <p>Category Added</p>
    </div>
    <div id="message" class="error below-h2 ct-msg ct_error_msg">
        <p>Issues adding Category.</p>
    </div>
    
    <div class="tbox">
        <div class="tbox-heading">
            <h3>Add New Category</h3>
            <a href="http://labs.think201.com/plugin/clients" target="_blank" class="pull-right">Need help?</a>
        </div>
        <div class="tbox-body">
            <form name="ct-add-category" id="ct-add-category" action="#" method="post">             
                <input type="hidden" name="action" value="page_add_category">
                <table class="form-table">

                    <tr valign="top">
                        <th scope="row">
                            <label for="category">Category:</label>
                        </td>
                        <td>
                            <input type="text" id="category" name="category" class="regular-text">
                        </td>
                    </tr>                                       

                </table>
                <p class="submit">      
                    <button onClick="CTForm.post('#ct-add-category')" class="button button-primary" type="button">Add Category</button>
                </p>
            </form>

        </div>
        <div class="tbox-footer">
            Categories helps you in organizing clients. Add as many categories you want from here.
        </div>
    </div>
</div>