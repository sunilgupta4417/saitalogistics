import React, {useState } from "react";
import { useAccount } from "wagmi";

export default function AccountConnection(){
  const [address, setAddress] = useState("");
  const [connector, setConnector] = useState({});

  const data1 = useAccount({
    onConnect({ address, connector, isReconnected }) {
      console.log('Connected', { address, connector, isReconnected });
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
  return (
    <div>
      <span>Address: {address}</span> <br />
      <span>Connected through: {connector?.name}</span><br />
    </div>
  );
};