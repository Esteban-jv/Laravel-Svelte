<script>
    import { format, formatDate } from 'date-fns'
    // import spanish locale for date-fns
    import { es } from 'date-fns/locale'
    // svelte imported date picker
    // import { DatePicker } from "@svelte-plugins/datepicker";
    // for maps
    import * as L from 'leaflet';
    import 'leaflet/dist/leaflet.css';
    // Header
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.svelte";
    // Custom Calendar
    import Calendar from "@/Components/Calendar.svelte";


    const jq = window.$ // Reemplazo de $ (JQuery) por jq para evitar conflictos con Svelte

    const json = j => {
        return JSON.stringify(j, null, 2)
    }

    let daterangeSelected = []
    let daterange = null

    // Ojo, se instala JQuery como npm y se le da un alias a $ como $j para poder inyectar JQuery en el script
    jq(function() {
        jq('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            daterangeSelected[0] = start
            daterangeSelected[1] = end

            console.warn(daterangeSelected)
        });
    });
    // for svelte datepicker

    let startDate = $state(new Date())
    let dateFormatted = $derived(
        format(startDate, "EEEE dd 'de' MMMM yyyy", {
            locale: es
        })
    )
    /*
    let dateFormat = 'MM/dd/yy';
    let formattedStartDate = formatDate(startDate);
    let isOpen = false;
    const toggleDatePicker = () => (isOpen = !isOpen);
    */

    // for maps
    let map;
    const zoom = 15
    const center = [20.50956, -87.2299585]

    function createMap(container) {
        // Create map object
        let m = L.map(container).setView(center, zoom);

        // Create LMarket
        const marker = L.marker(center, {
            draggable: true
        });
        // Add popup to a marker
        marker.bindPopup('Location <b>Name</b>.');
        // Add drag drop event to a marker
        marker.on('dragend', function (e) {
            console.log(m.getCenter());
        }).addTo(m); // Add marker to map (m)

        // Add container
        L.tileLayer(
            'https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png',
            {
                attribution: `&copy;<a href="https://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a>,
          &copy;<a href="https://carto.com/attributions" target="_blank">CARTO</a>`,
                subdomains: 'abcd',
                maxZoom: 20
            }
        ).addTo(m);

        return m;
    }

    // This thing is what we render in the div
    function mapAction(container) {
        map = createMap(container);
        return {
            destroy: () => {
                map.remove();
            },
        };
    }
</script>
<AuthenticatedLayout>
    <main class="mx-auto">
        <div class="mb-2">
            <h2 class="text-2xl text-orange-500 font-bold">Svelte 5</h2>
            <span>{dateFormatted}</span>

            <!-- make a tailwindcss calendar -->
            <div class="mt-5">
                <Calendar />
            </div>

            <!-- jquery calendar -->
            <input type="text" name="daterange" value="01/01/2018 - 01/15/2018" class="mt-5 bg-blue-400" /> <!-- Not working -->

            <!-- svelte calendar -->
<!--            <DatePicker bind:isOpen bind:startDate>-->
<!--                <input type="text" placeholder="Select date" bind:value={formattedStartDate} on:click={toggleDatePicker} />-->
<!--            </DatePicker>-->

            <!-- map grid -->
            <div class="mt-72" style="height:600px; width:800px">
                <div class="py-10" style="height: 600px;" use:mapAction />
            </div>
        </div>
    </main>
</AuthenticatedLayout>
