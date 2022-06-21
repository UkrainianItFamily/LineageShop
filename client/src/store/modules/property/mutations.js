import * as mutations from './types/mutations';
import { propertiesMapper } from './normalizer';

export default {
  [mutations.SET_CURRENT_PROPERTIES]: (state, properties) => {
    state.currentProperties = propertiesMapper(properties);
  }
};
