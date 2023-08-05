import React, { useEffect, useState } from "react";
import { parseEther } from "viem";
import { useAccount } from "wagmi";
import { useSendTransaction, usePrepareSendTransaction } from "wagmi";

export default function NormalTransaction(){
  const [address, setAddress] = useState("");
  const [connector, setConnector] = useState({});
  const [txhash, setTxhash] = useState("");


  const data1 = useAccount({
    onConnect({ address, connector, isReconnected }) {
      setAddress(address);
      console.log(connector);
      setConnector(connector);
    },
    onDisconnect() {
      setAddress("");
      console.log("Disconnected.");
      setConnector({});
    },
  });

  const { config } = usePrepareSendTransaction({
    to: "0x98dD76A9B39f05BfE6d9083D391eB74076Fd7560",
    value: parseEther("0.01"),
  });

  const { data, isLoading, isSuccess, sendTransaction } =
    useSendTransaction(config);

  useEffect(() => {
    setTxhash(data?.hash);
  }, [data, isLoading, isSuccess]);

  return (
    <div>
      <span>Address: {address}</span> <br />
      <span>Connected through: {connector?.name}</span><br />
      <button
        onClick={async () => {
          sendTransaction?.();
        }}
      >
        Donate 0.01
      </button><br />
      <span>Txn hash: {txhash}</span>
    </div>
  );
};