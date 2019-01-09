<template>
    <div class="theiaStickySidebar"
         style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; top: 0px; left: 119.5px;">
        <div id="filters_col">
            <a data-toggle="collapse" href="#" aria-expanded="false" aria-controls="collapseFilters"
               id="filters_col_bt">Filters </a>
            <div class="collapse show" id="collapseFilters">
                <div class="filter_type">
                    <h6>Category</h6>
                    <ul>
                        <li>
                            <label class="container_check">Restaurants
                                <small>43</small>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        <li>
                            <label class="container_check">Shops
                                <small>33</small>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        <li>
                            <label class="container_check">Bars
                                <small>12</small>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        <li>
                            <label class="container_check">Events
                                <small>44</small>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
            <!--/collapse -->
        </div>
    </div>
</template>

<script>
    export default {
        name: "ShopFilter"
    }
</script>

<style scoped>

</style>