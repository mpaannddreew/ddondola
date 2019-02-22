<template>
    <div class="card border p-4">
        <h6>Filters </h6>
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
            <div class="filter_type">
                <h6>Rating</h6>
                <ul>
                    <li>
                        <label class="container_check">Superb 9+
                            <small>34</small>
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </li>
                    <li>
                        <label class="container_check">Very Good 8+
                            <small>21</small>
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </li>
                    <li>
                        <label class="container_check">Good 7+
                            <small>15</small>
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </li>
                    <li>
                        <label class="container_check">Pleasant 6+
                            <small>34</small>
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </li>
                </ul>
            </div>
        </div>
        <!--/collapse -->
    </div>
</template>

<script>
    export default {
        name: "ShopFilter"
    }
</script>

<style scoped>

</style>