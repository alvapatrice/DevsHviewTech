
interface Waypoint {

}
interface WaypointObj {
    element : HTMLElement,
    handler(direction : string) : void,
    offset? : number,
    context? : HTMLElement
}

interface WaypointFactory {
    new(obj : WaypointObj);
}

declare var Waypoint : WaypointFactory;