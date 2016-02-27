angular.module('freeyachting').controller('BookingController', function() {
    this.forms = [];
    this.travellers = [];
    this.index = 1;
    this.places = [""];

    this.addTraveller = function(type, parent) {
        console.log('add traveller...');
        var traveller = {
            travelInitiator: "0",
            gender: 'm',
            livingWithParents: "1",
            oppositeGenderLiving: "0",
            type: typeof type == 'undefined' ? 'adult' : 'child',
            children: "0",
            placeNumber: ""
        };

        if (typeof parent != 'undefined') {
            if (typeof parent.childs == 'undefined') {
                parent.childs = [];
            }
            parent.childs.push(traveller);

            return;
        }

        this.travellers.push(traveller);
    };
    this.addChild = function(traveller) {
        traveller.childs = [];
        var childNumber = parseInt(traveller.childNumber) + 1;

        for (var i = 0; i < childNumber; i++) {
            this.addTraveller('child', traveller);
        }
    };
    this.addPlace = function(place) {
        this.places.push(place);
    }
});
