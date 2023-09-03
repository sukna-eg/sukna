      <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
               <p>Copyright © Developed by <a href="" target="_blank">AMA</a> 2023</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


	</div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->


    <script src="{{ asset('xhtml/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('xhtml/vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('xhtml/js/plugins-init/chartjs-init.js') }}"></script>
    <script src="{{ asset('xhtml/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
	<script src="{{ asset('xhtml/vendor/apexchart/apexchart.js') }}"></script>
	<!-- Dashboard 1 -->
	<script src="{{ asset('xhtml/js/dashboard/dashboard-1.js') }}"></script>
    {{-- <script src="{{ asset('xhtml/vendor/ckeditor/ckeditor.js') }}"></script> --}}
    <script src="{{ asset('xhtml/js/custom.js') }}"></script>
    <script src="{{ asset('xhtml/js/map.js') }}"></script>
	<script src="{{ asset('xhtml/js/deznav-init.js') }}"></script>
	{{-- <script src="./vendor/draggable/draggable.js"></script> --}}
    @stack('javasc')

	<!-- tagify -->
	<script src="{{ asset('xhtml/vendor/tagify/dist/tagify.js') }}"></script>

	<script src="{{ asset('xhtml/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('xhtml/vendor/datatables/js/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('xhtml/vendor/datatables/js/buttons.html5.min.js') }}"></script>
	<script src="{{ asset('xhtml/vendor/datatables/js/jszip.min.js') }}"></script>
	<script src="{{ asset('xhtml/js/plugins-init/datatables.init.js') }}"></script>
	<!-- Apex Chart -->

	<script src="{{ asset('xhtml/vendor/bootstrap-datetimepicker/js/moment.js') }}"></script>
	<script src="{{ asset('xhtml/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>

	<!-- Vectormap -->
    <script src="{{ asset('xhtml/vendor/jqvmap/js/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('xhtml/vendor/jqvmap/js/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('xhtml/vendor/jqvmap/js/jquery.vmap.usa.js') }}"></script>





</body>
</html>
