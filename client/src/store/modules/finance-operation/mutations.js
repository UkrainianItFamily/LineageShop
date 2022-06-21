import * as mutations from './types/mutations';
import { financeOperationsMapper } from './normalizer';
import { financeOperationMapper } from './normalizer';

export default {
  [mutations.SET_FINANCE_OPERATION]: (state, financeOperation) => {
    state.financeOperation = financeOperationMapper(financeOperation);
  },
  [mutations.CHANGE_STATUS_FINANCE_OPERATION]: (state, financeOperation) => {
    state.financeOperations = {
      ...state.financeOperations,
      [financeOperation.id]: financeOperationMapper(financeOperation)
    };
  },
  [mutations.SET_FINANCE_OPERATIONS]: (state, financeOperations) => {
    state.financeOperations = financeOperationsMapper(financeOperations);
  },
  [mutations.ADD_FINANCE_OPERATION]: (state, financeOperation) => {
    state.financeOperations = {
      ...state.financeOperations,
      [financeOperation.id]: financeOperationMapper(financeOperation)
    };
  }
};
