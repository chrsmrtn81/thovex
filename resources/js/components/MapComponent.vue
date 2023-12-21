<template>
    <section class='map-section'>
        <div class='map-section__map'></div>
        <button @click='toggleAddPoint' class='map-section__add-point-button' :class='{ "btn-primary": !addPointEnabled, "btn-danger": addPointEnabled }'>
            <div class='map-section__button-content'>
                <img v-if='addPointEnabled' src='/img/svg/map-pin-slash.svg' alt='Pin' />
                <img v-else src='/img/svg/map-pin.svg' alt='Pin' />
                <span>{{ addPointEnabled ? 'Disable Pins' : 'Enable Pins' }}</span>
            </div>
        </button>
    </section>
</template>

<script>
export default {
    data() {
        return {
            map: null,
            addPointEnabled: false,
            centreCoordinates: {
                lat: 51.70003649243157,
                lng: -1.8627889972208993,
                zoom: 11,
            },
        };
    },
    methods: {
        initMap() {
            this.map = new google.maps.Map(document.getElementsByClassName('map-section__map')[0], {
                center: { lat: this.centreCoordinates.lat, lng: this.centreCoordinates.lng },
                zoom: this.centreCoordinates.zoom,
            });

            this.map.addListener('click', (event) => {
                if (this.addPointEnabled) {
                    this.addMarker(event.latLng);
                    this.saveCoordinates(event.latLng.lat(), event.latLng.lng());
                }
            });
        },
        addMarker(location) {
            let customIcon = {
                url: '/img/png/landstack-icon.png',
                scaledSize: new google.maps.Size(40, 40),
            };

            new google.maps.Marker({
                position: location,
                map: this.map,
                icon: customIcon,
            });
        },
        saveCoordinates(lat, lng) {
            fetch('/api/save-point', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    latitude: lat,
                    longitude: lng,
                }),
            })
                .then((response) => response.json())
                .catch((error) => {
                    console.error('Error saving coordinates:', error);
                });
        },
        loadSavedPoints() {
            fetch('/api/get-points')
                .then((response) => response.json())
                .then((data) => {
                    data.forEach((point) => {
                        this.addMarker({
                            lat: point.latitude,
                            lng: point.longitude,
                        });
                    });
                })
                .catch((error) => {
                    console.error('Error loading saved points:', error);
                });
        },
        toggleAddPoint() {
            this.addPointEnabled = !this.addPointEnabled;
        },
    },
    mounted() {
        this.initMap();
        this.loadSavedPoints();
    },
};
</script>
