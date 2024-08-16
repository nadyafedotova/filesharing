export default function DetailsTable() {
    return {
        showDetails: false,
        toggleTable() {
            this.showDetails = !this.showDetails;
        }
    };
}
