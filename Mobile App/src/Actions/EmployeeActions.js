import { EMPLOYEE_UPDATE } from "../../../../ReactNative Graduation project/ReactNativeReduxCasts-master/manager/src/actions/types";
import {
    EMPLOYEE_UPDATE
} from './types';
export const employeeUpdate = ({ prop, value }) =>{
    return {
        type: EMPLOYEE_UPDATE,
        payload: {prop, value}
    };
};