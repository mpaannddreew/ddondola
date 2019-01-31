<template>
    <div>
        <h5>Leave a Review</h5>
        <form>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Rating </label>
                    <select class="form-control">
                        <option value="1">1 (lowest)</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5" selected="">5 (medium)</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10 (highest)</option>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label>Your Review</label>
                    <textarea class="form-control" style="height:130px;"></textarea>
                </div>
                <div class="form-group col-md-12 add_top_20 add_bottom_30">
                    <button class="btn btn-info" id="submit-review">Submit</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "ReviewForm"
    }
</script>

<style scoped>

</style>